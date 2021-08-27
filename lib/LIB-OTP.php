<?php
class OTP extends Core {
  // (A) ONE-TIME PASSWORD SETTINGS
  private $valid = 15; // VALID FOR X MINUTES
  private $tries = 3; // MAX TRIES
  private $passlength = 8; // PASSWORD LENGTH

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
      // @TODO - SET YOUR OWN RULES HERE - ALLOW NEW REQUEST IF EXIPRED?
      // $validTill = strtotime(check["otp_timestamp"]) + ($this->valid * 60);
      // if (strtotime("now") > $validTill) { DELETE OLD REQUEST }
      // else { ERROR }
      $this->error = "An OTP has already been sent";
      return false;
    }

    // (B3) GENERATE RANDOM PASSWORD
    $pass = $this->core->random($this->passlength);
    if (!$this->DB->insert("otp",
      ["user_email", "otp_pass"],
      [$email, password_hash($pass, PASSWORD_DEFAULT)], true)) {
      return false;
    }

    // (B4) SEND OTP VIA EMAIL
    // @TODO - FORMAT YOUR OWN "NICE EMAIL"
    $this->core->load("Mail");
    $this->core->Mail->to = $email;
    $this->core->Mail->subject = "Your OTP";
    $this->core->Mail->body = "Your OTP is $pass. Enter it at ".HOST_BASE."otp-demo-challenge.php within ".$this->valid." minutes.";
    if (!$this->core->Mail->send()) {
      $this->error = "Error sending OTP email";
      return false;
    }
    return true;
  }

  // (C) CHALLENGE OTP
  // @TODO - WHAT HAPPENS IF OTP FAILS ON TOO MANY TRIES OR EXPIRY?
  // GIVE CHANCES? CONTACT ADMIN? MANUAL CHECK?
  function challenge ($email, $pass) {
    // (C1) GET THE OTP ENTRY
    $otp = $this->DB->fetch("SELECT * FROM `otp` WHERE `user_email`=?", [$email]);
    if (!is_array($otp)) {
      $this->error = "The specified OTP request is not found.";
      return false;
    }

    // (C2) TOO MANY TRIES
    if ($otp["otp_tries"] >= $this->tries) {
      $this->error = "Too many tries for OTP, contact your admin.";
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
    //if ($pass != $otp["otp_pass"]) {
      $strikes = $otp["otp_tries"] + 1;
      if (!$this->DB->update("otp", ["otp_tries"], "`user_email`=?", [$strikes, $email])) {
        return false;
      }
      $this->error = "Incorrect OTP.";
      return false;
    }

    // (C5) ALL OK - DELETE OTP
    return $this->DB->query("DELETE FROM `otp` WHERE `user_email`=?", [$email]);
  }
}
