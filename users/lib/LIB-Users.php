<?php
class Users extends Core {
  // (A) PASSWORD CHECKER
  //  $password : password to check
  //  $pattern : regex pattern check (at least 8 characters, alphanumeric)
  function checker ($password, $pattern='/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/i') {
    if (preg_match($pattern, $password)) { return true; }
    else {
      $this->error = "Password must be at least 8 characters alphanumeric.";
      return false;
    }
  }

  // (B) ADD OR UPDATE USER
  //  $name : user name
  //  $email : user email
  //  $password : user password
  //  $id : user id (for updating only)
  function save ($name, $email, $password, $id=null) {
    // (B1) DATA SETUP + PASSWORD CHECK
    if (!$this->checker($password)) { return false; }
    $fields = ["user_name", "user_email", "user_password"];
    $data = [$name, $email, password_hash($password, PASSWORD_DEFAULT)];

    // (B2) ADD/UPDATE USER
    if ($id===null) {
      $this->DB->insert("users", $fields, $data);
    } else {
      $data[] = $id;
      $this->DB->update("users", $fields, "`user_id`=?", $data);
    }
    return true;
  }

  // (C) UPDATE ACCOUNT (LIMITED SAVE)
  function update ($name, $email, $password) {
    // (C1) MUST BE SIGNED IN
    if (!isset($this->Session->data["user"])) {
      $this->error = "Please sign in first";
      return false;
    }
    
    // (C2) UPDATE DATABASE
    $this->DB->update("users",
      ["user_name", "user_email", "user_password"], "`user_id`=?",
      [$name, $email, password_hash($password, PASSWORD_DEFAULT), $this->Session->data["user"]["user_id"]]
    );
    return true;
  }

  // (D) REGISTER USER - RESTRICTED VERSION OF "SAVE" FOR FRONT-END
  //  $name : user name
  //  $email : user email
  //  $password : user password
  function register ($name, $email, $password) {
    // (D1) ALREADY SIGNED IN
    if (isset($this->Session->data["user"])) {
      $this->error = "You are already signed in.";
      return false;
    }

    // (D2) CHECK USER EXIST
    if (is_array($this->get($email))) {
      $this->error = "$email is already registered.";
      return false;
    }

    // (D3) SAVE
    $this->save($name, $email, $password);
    return true;
  }

  // (E) DELETE USER
  //  $id : user id
  function del ($id) {
    $this->DB->delete("users", "`user_id`=?", [$id]);
    return true;
  }

  // (F) GET USER
  //  $id : user id or email
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `users` WHERE `user_". (is_numeric($id)?"id":"email") ."`=?",
      [$id]
    );
  }

  // (G) GET ALL OR SEARCH USERS
  //  $search : optional, user name or email
  //  $page : optional, current page number
  function getAll ($search=null, $page=null) {
    // (G1) PARITAL USERS SQL + DATA
    $sql = "FROM `users`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `user_name` LIKE ? OR `user_email` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }

    // (G2) PAGINATION
    if ($page != null) {
      $this->Core->paginator(
        $this->DB->fetchCol("SELECT COUNT(*) $sql", $data), $page
      );
      $sql .= $this->Core->page["lim"];
    }

    // (G3) RESULTS
    return $this->DB->fetchAll("SELECT * $sql", $data, "user_id");
  }

  // (H) VERIFY EMAIL & PASSWORD (LOGIN OR SECURITY CHECK)
  // RETURNS USER ARRAY IF VALID, FALSE IF INVALID
  //  $email : user email
  //  $password : user password
  function verify ($email, $password) {
    // (H1) GET USER
    $user = $this->get($email);
    $pass = is_array($user);

    // (H2) PASSWORD CHECK
    if ($pass) {
      $pass = password_verify($password, $user["user_password"]);
    }

    // (H3) RESULTS
    if (!$pass) {
      $this->error = "Invalid user or password.";
      return false;
    }
    return $user;
  }

  // (I) LOGIN
  //  $email : user email
  //  $password : user password
  function login ($email, $password) {
    // (I1) ALREADY SIGNED IN
    if (isset($this->Session->data["user"])) { return true; }

    // (I2) VERIFY EMAIL PASSWORD
    $user = $this->verify($email, $password);
    if ($user===false) { return false; }

    // (I3) SESSION START
    $this->Session->data["user"] = $user;
    unset($this->Session->data["user"]["user_password"]);
    $this->Session->save();
    return true;
  }

  // (J) LOGOUT
  function logout () {
    // (J1) ALREADY SIGNED OFF
    if (!isset($this->Session->data["user"])) { return true; }

    // (J2) END SESSION
    $this->Session->destroy();
    return true;
  }
}