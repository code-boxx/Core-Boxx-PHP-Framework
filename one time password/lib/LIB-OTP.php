<?php
class OTP extends Core {
  // (A) ONE-TIME PASSWORD SETTINGS
  private $valid = 15; // valid for x minutes
  private $tries = 3; // max tries
  private $passlength = 8; // password length - 16 characters

  // (B) GENERATE OTP
  function generate ($email) {
    // (B1) GET USER + EXISTING OTP
    $this->Core->load("Users");
    $user = $this->Users->get($email, "O");
    if (!is_array($user)) {
      $this->error = "$email is not registered";
      return false;
    }

    // (B2) CHECK IF THERE IS AN EXISTING OTP REQUESTS
    if (isset($user["hash_code"])) {
      // (B2-1) MUST WAIT FOR EXPIRY BEFORE RESEND
      $expire = strtotime($user["hash_time"]) + $this->valid;
      $now = strtotime("now");
      $left = $now - $expire;
      if ($left < 0) {
        $this->error = "Please wait another ".abs($left)." seconds.";
        return false;
      }

      // (B2-2) TOO MANY TRIES
      if ($user["hash_tries"] >= $this->tries) {
        $this->error = "You have exceeded the max number of tries.";
        return false;
      }
    }

    // (B3) GENERATE RANDOM PASSWORD
    $pass = $this->Core->random($this->passlength);
    $this->DB->replace("users_hash",
      ["user_id", "hash_for", "hash_code", "hash_time", "hash_tries"],
      [
        $user["user_id"], "O", password_hash($pass, PASSWORD_DEFAULT),
        date("Y-m-d H:i:s"), 0
      ]
    );

    // (B4) SEND OTP VIA EMAIL
    // @TODO - complete your own otp email
    $this->Core->load("Mail");
    return $this->Mail->send([
      "from" => "sys@site.com",
      "to" => $email,
      "subject" => "Your OTP",
      "template" => PATH_PAGES . "MAIL-otp.php",
      "vars" => [
        "password" => $pass,
        "link" => HOST_BASE . "otp/2"
      ]
    ]);
  }

  // (C) CHALLENGE OTP
  function challenge ($email, $pass) {
    // (C1) GET THE OTP ENTRY
    $this->Core->load("Users");
    $user = $this->Users->get($email, "O");
    if (!is_array($user)) {
      $this->error = "The specified OTP request is not found.";
      return false;
    }

    // (C2) TOO MANY TRIES
    if ($user["hash_tries"] >= $this->tries) {
      $this->error = "Too many tries for OTP.";
      return false;
    }

    // (C3) EXPIRED
    $validTill = strtotime($user["hash_time"]) + ($this->valid * 60);
    if (strtotime("now") > $validTill) {
      $this->error = "OTP has expired.";
      return false;
    }

    // (C4) INCORRECT PASSWORD - ADD STRIKE
    if (!password_verify($pass, $user["hash_code"])) {
      $strikes = $user["hash_tries"] + 1;
      $this->DB->update(
        "users_hash", ["hash_tries"],
        "`user_id`=? AND `hash_for`=?",
        [$strikes, $user["user_id"], "O"]
      );
      if ($strikes >= $this->tries) {
        // @TODO - what happens if otp fails on too many strikes?
        // give chances? contact admin? manual check? suspend account?
      }
      $this->error = "Incorrect OTP.";
      return false;
    }

    // (C5) ALL OK - DELETE OTP
    $this->DB->delete("users_hash",
      "`user_id`=? AND `hash_for`=?",
      [$user["user_id"], "O"]
    );
    return true;
  }
}