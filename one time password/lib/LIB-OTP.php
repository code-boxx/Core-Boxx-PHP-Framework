<?php
class OTP extends Core {
  // (A) ONE-TIME PASSWORD SETTINGS
  private $valid = 15; // valid for x minutes
  private $tries = 3; // max tries
  private $passlength = 8; // password length

  // (B) GENERATE OTP
  function generate ($email) {
    // (B1) CHECK IF USER IS REGISTERED
    $this->core->load("Users");
    $check = $this->core->Users->get($email);
    if (!is_array($check)) {
      $this->error = "$email is not registered";
      return false;
    }

    // (B2) CHECK IF USER ALREADY HAS EXISTING OTP REQUEST
    $check = $this->DB->fetch("SELECT * FROM `otp` WHERE `user_email`=?", [$email]);
    if (is_array($check)) {
      // (B2-1) MUST WAIT FOR EXPIRY BEFORE RESEND
      $expire = strtotime($check["otp_timestamp"]) + $this->valid;
      $now = strtotime("now");
      $left = $now - $expire;
      if ($left <0) {
        $this->error = "Please wait another ".abs($left)." seconds.";
        return false;
      }

      // (B2-2) TOO MANY TRIES
      if ($check["otp_tries"] >= $this->tries) {
        $this->error = "You have exceeded the max number of tries.";
        return false;
      }
    }

    // (B3) GENERATE RANDOM PASSWORD
    $pass = $this->core->random($this->passlength);
    $this->DB->replace("otp",
      ["user_email", "otp_pass", "otp_tries"], [
        $email, password_hash($pass, PASSWORD_DEFAULT),
        isset($check) ? $check["otp_tries"] : 0
      ]
    );

    // (B4) SEND OTP VIA EMAIL
    $this->core->load("Mail");
    return $this->core->Mail->send([
      // @TODO - format your own "nice email"
      "from" => "sys@site.com",
      "to" => $email,
      "subject" => "Your OTP",
      "template" => PATH_PAGES . "MAIL-otp.php",
      "vars" => [
        "password" => $pass,
        "link" => HOST_BASE . "otp/two"
      ]
    ]);
  }

  // (C) CHALLENGE OTP
  function challenge ($email, $pass) {
    // (C1) GET THE OTP ENTRY
    $otp = $this->DB->fetch("SELECT * FROM `otp` WHERE `user_email`=?", [$email]);
    if (!is_array($otp)) {
      $this->error = "The specified OTP request is not found.";
      return false;
    }

    // (C2) TOO MANY TRIES
    if ($otp["otp_tries"] >= $this->tries) {
      $this->error = "Too many tries for OTP.";
      return false;
    }

    // (C3) EXPIRED
    $validTill = strtotime($otp["otp_timestamp"]) + ($this->valid * 60);
    if (strtotime("now") > $validTill) {
      $this->error = "OTP has expired.";
      return false;
    }

    // (C4) INCORRECT PASSWORD - ADD STRIKE
    if (!password_verify($pass, $otp["otp_pass"])) {
      $strikes = $otp["otp_tries"] + 1;
      $this->DB->update("otp", ["otp_tries"], "`user_email`=?", [$strikes, $email]);
      if ($strikes >= $this->tries) {
        // @TODO - what happens if otp fails on too many strikes?
        // give chances? contact admin? manual check? suspend account?
      }
      $this->error = "Incorrect OTP.";
      return false;
    }

    // (C5) ALL OK - DELETE OTP
    $this->DB->delete("otp", "`user_email`=?", [$email]);
    return true;
  }
}
