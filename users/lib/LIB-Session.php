<?php
class Session extends Core {
  // (A) COMMON COOKIE "TEMPLATE"
  private $cookie = [
    "domain" => HOST_NAME,
    "path" => "/",
    "httponly" => true
    // "secure" => true,
    // "samesite" => "None"
  ];

  // (B) CREATE JWT COOKIE
  //  $data : data array to put into the JWT cookie
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
  // * no return value, just outputs cookie
  function expire () {
    // (C1) SET HTTP COOKIE
    $copt = $this->cookie;
    $copt["expires"] = -1;
    setcookie("jwt", null, $copt);

    // (C2) "WITH IMMEDIATE EFFECT"
    if (isset($_COOKIE["jwt"])) { unset ($_COOKIE["jwt"]); }
  }

  // (D) VALIDATE & DECODE JWT COOKIE
  // * return decode token if valid, false if not
  function validate () {
    // (D1) COOKIE EXIST?
    $valid = isset($_COOKIE["jwt"]);

    // (D2) DECODE JWT COOKIE
    if ($valid) {
      try {
        require PATH_LIB . "jwt/autoload.php";
        $token = Firebase\JWT\JWT::decode($_COOKIE["jwt"], JWT_SECRET, [JWT_ALGO]);
        $valid = is_object($token);
      } catch (Exception $e) { $valid = false; }
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

    // (D4) RESULT
    return $valid ? $token->data : false;
  }

  // (E) VALIDATE JWT & "PARSE" DATA INTO $_SESS
  function start () {
    // (E1) UNPACK COOKIE DATA
    $data = $this->validate();
    if ($data===false) { return false; }

    // (E2) GET USER FROM DATABASE
    $user = $this->DB->fetch(
      "SELECT * FROM `users` WHERE `user_id`=?", [$data->user_id]
    );

    // (E3) INVALID USER!
    if ($user===null) {
      $this->expire();
      throw new Exception("Invalid user!");
    }

    // (E4) VALID USER
    global $_SESS;
    unset($user["user_password"]);
    $_SESS["user"] = $user;
  }

  // (F) SET USER INTO JWT COOKIE
  //  $user : array, user data
  function set ($user) {
    $this->create(["user_id" => $user["user_id"]]);
    if (isset($user["user_password"])) { unset($user["user_password"]); }
    global $_SESS;
    $_SESS["user"] = $user;
  }

  // (E) END SESSION
  function unset () {
    $this->expire();
    global $_SESS;
    unset($_SESS["user"]);
  }
}
