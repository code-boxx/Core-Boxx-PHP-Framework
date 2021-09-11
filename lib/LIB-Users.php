<?php
class Users extends Core {
  // (A) ADD OR UPDATE USER
  function save ($name, $email, $password, $id=null) {
    // (A1) DATA SETUP
    $fields = ["user_name", "user_email", "user_password"];
    $data = [$name, $email, password_hash($password, PASSWORD_DEFAULT)];

    // (A2) ADD USER
    if ($id===null) {
      return $this->DB->insert("users", $fields, $data);
    }

    // (A3) UPDATE USER
    else {
      $data[] = $id;
      return $this->DB->update("users", $fields, "`user_id`=?", $data);
    }
  }

  // (B) DELETE USER
  function del ($id) {
    return $this->DB->query("DELETE FROM `users` WHERE `user_id`=?", [$id]);
  }

  // (C) GET USER
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `users` WHERE `user_". (is_numeric($id)?"id":"email") ."`=?",
      [$id]
    );
  }

  // (D) COUNT (FOR SEARCH & PAGINATION)
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
  function getAll ($search=null, $page=1) {
    // (E1) PAGINATION
    $entries = $this->count($search);
    $pgn = $this->core->paginator($entries, $page);

    // (E2) GET USERS
    $sql = "SELECT * FROM `users`";
    $data = null;
    if ($search != null) {
      $sql .= " WHERE `user_name` LIKE ? OR `user_email` LIKE ?";
      $data = ["%$search%", "%$search%"];
    }
    $sql .= " LIMIT {$pgn['x']}, {$pgn['y']}";
    return [
      "data" => $this->DB->fetchAll($sql, $data, "user_id"),
      "page" => $pgn
    ];
  }

  // (F) VERIFY EMAIL & PASSWORD (LOGIN OR SECURITY CHECK)
  function verify ($email, $password, $session=true) {
    // (F1) GET USER
    $user = $this->get($email);
    $pass = is_array($user);

    // (F2) PASSWORD CHECK
    if ($pass) { $pass = password_verify($password, $user['user_password']); }

    // (F3) START SESSION - SESSION_START() BEFORE THIS!
    if ($pass) {
      $_SESSION['user'] = [];
      foreach ($user as $k=>$v) {
        if ($k!="user_password") { $_SESSION['user'][$k] = $v; }
      }
    }

    // (F4) RESULTS
    if (!$pass) { $this->error = "Invalid user or password."; }
    return $pass;
  }
}
