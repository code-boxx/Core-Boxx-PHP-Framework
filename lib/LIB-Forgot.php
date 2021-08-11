<?php
class Forgot extends Core {
  // Request will be valid for N seconds.
  // Also to prevent spam, cannot make another request until expire.
  private $valid = 900; // 15 mins = 900 secs

  // (A) GET PASSWORD RESET REQUEST
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `password_reset` WHERE `user_id`=?", [$id]
    );
  }

  // (B) PASSWORD RESET REQUEST
  function request ($email) {
    // (B1) CHECK IF VALID USER
    $this->core->load("Users");
    $user = $this->core->Users->get($email);
    if (!is_array($user)) {
      $this->error = "$email is not registered.";
      return false;
    }

    // (B2) CHECK PREVIOUS REQUEST (PREVENT SPAM)
    $req = $this->get($user['user_id']);
    if (is_array($req)) {
      $expire = strtotime($req['reset_time']) + $this->valid;
      $now = strtotime("now");
      $left = $now - $expire;
      if ($left <0) {
        $this->error = "Please wait another ".abs($left)." seconds.";
        return false;
      }
    }

    // (B3) CHECKS OK - CREATE NEW RESET REQUEST
    $now = strtotime("now");
    $hash = md5($user['user_email'] . $now); // Random hash
    if (!$this->DB->insert("password_reset",
      ["user_id", "reset_hash", "reset_time"],
      [$user['user_id'], $hash, date("Y-m-d H:i:s")], true
    )) { return false; }

    // (B4) SEND EMAIL TO USER
    // @TODO - SET YOUR OWN EMAIL MESSAGE + RESET LINK
    $this->core->load("Mail");
    $this->core->Mail->to = $user['user_email'];
    $this->core->Mail->subject = "Password Reset";
    $this->core->Mail->body = "<a href='".HOST_BASE."2-forgot-reset.php?i={$user['user_id']}&h={$hash}'>RESET</a>";
    if (!$this->core->Mail->send()) {
      $this->error = "Error sending mail";
      return false;
    }
    return true;
  }

  // (C) PROCESS PASSWORD RESET
  function reset ($id, $hash) {
    // (C1) CHECKS
    // GET REQUEST
    $req = $this->get($id);
    $pass = is_array($req);
    // CHECK EXPIRE
    if ($pass) {
      $expire = strtotime($req['reset_time']) + $this->valid;
      $now = strtotime("now");
      $pass = $now <= $expire;
    }
    // CHECK HASH
    if ($pass) { $pass = $hash==$req['reset_hash']; }
    // GET USER
    if ($pass) {
      $this->core->load("Users");
      $user = $this->core->Users->get($id);
      $pass = is_array($user);
    }
    // CHECK FAIL - INVALID REQUEST
    if (!$pass) {
      $this->error = "Invalid request.";
      return false;
    }

    // (C2) CHECK PASS - PROCEED RESET
    // RANDOM NEW PASSWORD
    $password = $this->core->random(12);
    // UPDATE USER PASSWORD
    $this->DB->start();
    $pass = $this->DB->update(
      "users", ["user_password"], "`user_id`=?",
      [password_hash($password, PASSWORD_DEFAULT), $id]
    );
    // REMOVE REQUEST
    if ($pass) {
      $pass = $this->DB->query("DELETE FROM `password_reset` WHERE `user_id`=?", [$id]);
    }
    // EMAIL TO USER
    // @TODO - SET YOUR OWN EMAIL MESSAGE
    if ($pass) {
      $this->core->load("Mail");
      $this->core->Mail->to = $user['user_email'];
      $this->core->Mail->subject = "Password Reset";
      $this->core->Mail->body = "$password";
      if (!$this->core->Mail->send()) {
        $this->error = "Error sending mail";
        $pass = false;
      }
    }
    // CLOSE
    $this->DB->end($pass);
    return $pass;
  }
}
