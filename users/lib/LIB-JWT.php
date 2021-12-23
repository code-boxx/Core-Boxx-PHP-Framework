<?php
class JWT extends Core {
  // (A) COOKIE OPTIONS
  private $cookie = [
    "domain" => HOST_NAME,
    "path" => "/",
    "httponly" => true
    // "secure" => true,
    // "samesite" => "None"
  ];

  // (B) CREATE JWT TOKEN
  //  $data : custom data array, include your own data if required
  //          but make sure "user_id" is included
  function create ($data) {
    // (B1) LOAD PHP-JWT
    require PATH_LIB . "jwt/autoload.php";

    // (B2) GENERATE JWT
    $now = strtotime("now");
    $token = [
      "iat" => $now, // ISSUED AT
      "nbf" => $now, // NOT BEFORE
      "jti" => base64_encode(random_bytes(16)), // JSON TOKEN ID
      "iss" => JWT_ISSUER, // ISSUER
      "aud" => HOST_NAME, // AUDIENCE
      "data" => $data // ADDITIONAL DATA
    ];
    if (JWT_EXPIRE > 0) { $token["exp"] = $now + JWT_EXPIRE; } // EXPIRY
    $token = Firebase\JWT\JWT::encode($token, JWT_SECRET, JWT_ALGO);

    // (B3) HTTP COOKIE
    $copt = $this->cookie;
    $copt["expires"] = 0;
    setcookie("jwt", $token, $copt);

    // (B4) "FORCE IMMEDIATE START"
    $_COOKIE["jwt"] = $token;
  }

  // (C) EXPIRE JWT COOKIE
  function expire () {
    $copt = $this->cookie;
    $copt["expires"] = -1;
    setcookie("jwt", null, $copt);
  }

  // (D) VERIFY JWT TOKEN
  //  $set : set the user data into $globals["_user"]
  function verify ($set=true) {
    // (D1) JWT COOKIE SET?
    $valid = isset($_COOKIE["jwt"]);

    // (D2) DECODE JWT COOKIE
    if ($valid) {
      require PATH_LIB . "jwt/autoload.php";
      try { $token = Firebase\JWT\JWT::decode($_COOKIE["jwt"], JWT_SECRET, [JWT_ALGO]); }
      catch (Exception $e) { $valid = false; }
      if ($valid) { $valid = is_object($token); }
    }

    // (D3) EXPIRED? VALID ISSUER? VALID AUDIENCE?
    if ($valid) {
      $now = strtotime("now");
      $valid = $token->iss == JWT_ISSUER &&
               $token->aud == HOST_NAME &&
               $token->nbf <= $now;
      if ($valid && JWT_EXPIRE!=0) {
        $valid = isset($token->exp) ? ($token->exp < $now) : false;
      }
    }

    // (D4) OK - "REGISTER" USER?
    if ($set) {
      if ($valid) { $valid = $this->set($token->data->user_id); }
      else { $GLOBALS["_USER"] = false; }
    }

    // (D5) RESULT
    if ($valid) { return true; }
    else {
      $this->error = "Invalid or expired token";
      return false;
    }
  }

  // (E) SET USER INTO $_USER
  //  $user : user id or array
  function set ($user) {
    // (E1) GET USER
    if (is_numeric($user)) {
      $user = $this->DB->fetch(
        "SELECT * FROM `users` WHERE `user_id`=?", [$user]
      );
      if ($user==null) { return false; }
      unset($user["user_password"]);
    }

    // (E2) SET USER
    $GLOBALS["_USER"] = $user;
    return true;
  }
}
