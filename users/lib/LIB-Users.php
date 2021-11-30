<?php
class Users extends Core {
  // (A) ADD OR UPDATE USER
  //  $name : user name
  //  $email : user email
  //  $password : user password
  //  $id : user id (for updating only)
  function save ($name, $email, $password, $id=null) {
    // (A1) DATA SETUP
    $fields = ["user_name", "user_email", "user_password"];
    $data = [$name, $email, password_hash($password, PASSWORD_DEFAULT)];

    // (A2) ADD/UPDATE USER
    if ($id===null) {
      return $this->DB->insert("users", $fields, $data);
    } else {
      $data[] = $id;
      return $this->DB->update("users", $fields, "`user_id`=?", $data);
    }
  }

  // (B) DELETE USER
  //  $id : user id
  function del ($id) {
    return $this->DB->query("DELETE FROM `users` WHERE `user_id`=?", [$id]);
  }

  // (C) GET USER
  //  $id : user id or email
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `users` WHERE `user_". (is_numeric($id)?"id":"email") ."`=?",
      [$id]
    );
  }

  // (D) COUNT (FOR SEARCH & PAGINATION)
  //  $search : optional, user name or email
  function count ($search=null) {
    $sql = "SELECT COUNT(*) FROM `users`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `user_name` LIKE ? OR `user_email` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    return $this->DB->fetchCol($sql, $data);
  }

  // (E) GET ALL OR SEARCH USERS
  //  $search : optional, user name or email
  //  $page : optional, current page number
  function getAll ($search=null, $page=1) {
    // (E1) PAGINATION
    $entries = $this->count($search);
    if ($entries===false) { return false; }
    $pgn = $this->core->paginator($entries, $page);

    // (E2) GET USERS
    $sql = "SELECT `user_id`, `user_name`, `user_email` FROM `users`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `user_name` LIKE ? OR `user_email` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    $sql .= " LIMIT {$pgn["x"]}, {$pgn["y"]}";
    $users = $this->DB->fetchAll($sql, $data, "user_id");
    if ($users===false) { return false; }

    // (E3) RESULTS
    return ["data" => $users, "page" => $pgn];
  }

  // (F) VERIFY EMAIL & PASSWORD (LOGIN OR SECURITY CHECK)
  // RETURNS USER ARRAY IF VALID, FALSE IF INVALID
  //  $email : user email
  //  $password : user password
  function verify ($email, $password) {
    // (F1) GET USER
    $user = $this->get($email);
    if ($user===false) { return false; }
    $pass = is_array($user);

    // (F2) PASSWORD CHECK
    if ($pass) {
      $pass = password_verify($password, $user['user_password']);
    }

    // (F3) RESULTS
    if (!$pass) {
      $this->error = "Invalid user or password.";
      return false;
    }
    return $user;
  }

  // (G) LOGIN - USER SESSION
  // MAKE SURE SESSION_START() ENABLED IN LIB/GO.PHP!
  //  $email : user email
  //  $password : user password
  function inSess ($email, $password) {
    // (G1) ALREADY SIGNED IN
    if (isset($_SESSION["user"])) { return true; }

    // (G2) VERIFY EMAIL PASSWORD
    $user = $this->verify($email, $password);
    if ($user===false) { return false; }

    // (G3) REGISTER USER IN SESSION
    $_SESSION["user"] = [];
    foreach ($user as $k=>$v) {
      if ($k!="user_password") { $_SESSION["user"][$k] = $v; }
    }
    return true;
  }

  // (H) LOGIN - JWT COOKIE
  //  $email : user email
  //  $password : user password
  function inJWT ($email, $password) {
    // (H1) ALREADY SIGNED IN
    if ($this->verifyJWT()) { return true; }

    // (H2) VERIFY EMAIL PASSWORD
    $user = $this->verify($email, $password);
    if ($user===false) { return false; }

    // (H3) GENERATE TOKEN
    require PATH_LIB . "/jwt/autoload.php";
    $now = strtotime("now");
    $token = [
      "iat" => $now, // ISSUED AT
      "ndf" => $now, // NOT BEFORE
      "jti" => base64_encode(random_bytes(16)), // JSON TOKEN ID
      "iss" => JWT_ISSUER, // ISSUER
      "aud" => HOST_NAME, // AUDIENCE
      "data" => []
    ];
    if (JWT_EXPIRE > 0) { $token["exp"] = $now + JWT_EXPIRE; }
    foreach ($user as $k=>$v) {
      if ($k!="user_password") { $token["data"][$k] = $v; }
    }
    $token = Firebase\JWT\JWT::encode($token, JWT_SECRET, JWT_ALGO);
    setcookie("jwt", $token, 0, "/", HOST_NAME, API_HTTPS);
    return true;
  }

  // (I) VERIFY JWT TOKEN
  function verifyJWT () {
    // (I1) JWT COOKIE SET?
    $valid = isset($_COOKIE["jwt"]);

    // (I2) DECODE JWT COOKIE
    if ($valid) {
      require PATH_LIB . "/jwt/autoload.php";
      try { $token = Firebase\JWT\JWT::decode($_COOKIE["jwt"], JWT_SECRET, [JWT_ALGO]); }
      catch (Exception $e) { $valid = false; }
    }

    // (I3) EXPIRED? VALID ISSUER? VALID AUDIENCE?
    if ($valid) {
      $now = strtotime("now");
      $valid = $token->iss == JWT_ISSUER &&
               $token->aud == HOST_NAME &&
               $token->nbf <= $now;
      if ($valid && JWT_EXPIRE!=0) { $valid = $token->exp < $now; }
    }

    // (I4) RESULT
    if (!$valid) {
      $this->error = "Invalid or expired token";
      return false;
    }
    return true;
  }
}
