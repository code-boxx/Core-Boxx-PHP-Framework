<?php
class NFCIN extends Core {
  // (A) SETTINGS
  private $nlen = 12; // 12 characters nfc login random hash

  // (B) CREATE NEW NFC LOGIN TOKEN
  //  $id : user id
  function add ($id) {
    // (B1) UPDATE TOKEN
    $token = $this->Core->random($this->nlen);
    $this->DB->replace("users_hash",
      ["user_id", "hash_for", "hash_code", "hash_time", "hash_tries"],
      [$id, "N", $token, date("Y-m-d H:i:s"), 0]
    );

    // (B2) RETURN ENCODED TOKEN
    require PATH_LIB . "JWT/autoload.php";
    return Firebase\JWT\JWT::encode([$id, $token], JWT_SECRET, JWT_ALGO);
  }

  // (C) NULLIFY NFC TOKEN
  //  $id : user id
  function del ($id) {
    $this->DB->delete("users_hash", "`user_id`=? AND `hash_for`='N'", [$id]);
    return true;
  }

  // (D) NFC TOKEN LOGIN
  function login ($token) {
    // (D1) DECODE TOKEN
    $valid = true;
    try {
      require PATH_LIB . "JWT/autoload.php";
      $token = Firebase\JWT\JWT::decode(
        $token, new Firebase\JWT\Key(JWT_SECRET, JWT_ALGO)
      );
      $valid = is_object($token);
      if ($valid) {
        $token = (array) $token;
        $valid = count($token)==2;
      }
    } catch (Exception $e) { $valid = false; }

    // (D2) VERIFY TOKEN
    if ($valid) {
      $this->Core->load("Users");
      $user = $this->Users->get($token[0], "N");
      $valid = (is_array($user) && $user["hash_code"]==$token[1]);
    }

    // (D3) SESSION START
    if ($valid) {
      $_SESSION["user"] = $user;
      unset($_SESSION["user"]["user_password"]);
      unset($_SESSION["user"]["hash_code"]);
      unset($_SESSION["user"]["hash_time"]);
      unset($_SESSION["user"]["hash_tries"]);
      $this->Session->save();
      return true;
    }

    // (D4) NADA
    $this->error = "Invalid token";
    return false;
  }
}