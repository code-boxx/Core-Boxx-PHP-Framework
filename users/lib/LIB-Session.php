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

  // (D) START USER SESSION
  //  no return value, simply sets $_user global
  //  $user : array of user data, force start a new session
  function start ($user=null) {
    // (D1) GLOBAL USER VARIABLE
    global $_USER;

    // (D2) START USER SESSION FROM JWT COOKIE
    if ($user===null) {
      // (D2-1) INVALID - NO JWT COOKIE
      if (!isset($_COOKIE["jwt"])) { $_USER = false; }

      // (D2-2) VERIFY JWT COOKIE
      else {
        // DECODE JWT COOKIE
        $valid = false;
        try {
          require PATH_LIB . "jwt/autoload.php";
          $token = Firebase\JWT\JWT::decode($_COOKIE["jwt"], JWT_SECRET, [JWT_ALGO]);
          $valid = is_object($token);
        } catch (Exception $e) { $valid = false; }

        // EXPIRED? VALID ISSUER? VALID AUDIENCE?
        if ($valid) {
          $now = strtotime("now");
          $valid = $token->iss == JWT_ISSUER &&
                   $token->aud == HOST_NAME &&
                   $token->nbf <= $now;
          if ($valid && JWT_EXPIRE!=0) {
            $valid = isset($token->exp) ? ($token->exp < $now) : false;
          }
        }

        // GET USER
        if ($valid) {
          $_USER = $this->DB->fetch(
            "SELECT * FROM `users` WHERE `user_id`=?", [$token->data->user_id]
          );
          if ($_USER===null) { $_USER = false; }
          if (isset($_USER["user_password"])) { unset($_USER["user_password"]); }
        }
      }
    }

    // (D3) START USER SESSION FOR GIVEN USER ARRAY
    else {
      $this->create(["user_id" => $user["user_id"]]);
      $_USER = $user;
      if (isset($_USER["user_password"])) { unset($_USER["user_password"]); }
    }
  }

  // (E) END SESSION
  function end () {
    global $_USER;
    $_USER = false;
    $this->expire();
  }
}
