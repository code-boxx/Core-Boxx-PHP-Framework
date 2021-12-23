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

  // (D) GET ALL OR SEARCH USERS
  //  $search : optional, user name or email
  //  $page : optional, current page number
  function getAll ($search=null, $page=null) {
    // (D1) PARITAL USERS SQL + DATA
    $sql = "FROM `users`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `user_name` LIKE ? OR `user_email` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }

    // (D2) PAGINATION
    if ($page != null) {
      $pgn = $this->core->paginator(
        $this->DB->fetchCol("SELECT COUNT(*) $sql", $data), $page
      );
      $sql .= " LIMIT {$pgn["x"]}, {$pgn["y"]}";
    }

    // (D3) RESULTS
    $users = $this->DB->fetchAll("SELECT * $sql", $data, "id");
    return $page != null
     ? ["data" => $users, "page" => $pgn]
     : $users ;
  }

  // (E) VERIFY EMAIL & PASSWORD (LOGIN OR SECURITY CHECK)
  // RETURNS USER ARRAY IF VALID, FALSE IF INVALID
  //  $email : user email
  //  $password : user password
  function verify ($email, $password) {
    // (E1) GET USER
    $user = $this->get($email);
    if ($user===false) { return false; }
    $pass = is_array($user);

    // (E2) PASSWORD CHECK
    if ($pass) {
      $pass = password_verify($password, $user["user_password"]);
    }

    // (E3) RESULTS
    if (!$pass) {
      $this->error = "Invalid user or password.";
      return false;
    }
    return $user;
  }

  // (F) LOGIN
  //  $email : user email
  //  $password : user password
  function login ($email, $password) {
    // (F1) ALREADY SIGNED IN
    $this->core->load("JWT");
    if ($this->core->JWT->verify(false)) { return true; }

    // (F2) VERIFY EMAIL PASSWORD
    $user = $this->verify($email, $password);
    if ($user===false) { return false; }

    // (F3) GENERATE TOKEN + REGISTER USER
    $this->core->JWT->create(["user_id" => $user["user_id"]]);
    unset($user["user_password"]);
    $this->core->JWT->set($user);
    return true;
  }
}
