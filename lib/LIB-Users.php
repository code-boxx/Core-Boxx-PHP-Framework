<?php
class Users extends Core {
  // (A) ADD OR UPDATE USER
  function save ($name, $email, $password, $id=null) {
    // (A1) ADD USER
    if ($id===null) {
      return $this->DB->insert("users",
        ["user_name", "user_email", "user_password"],
        [$name, $email, password_hash($password, PASSWORD_DEFAULT)]
      );
    }
    // (A2) UPDATE USER
    else {
      return $this->DB->update("users",
        ["user_name", "user_email", "user_password"],
        "`user_id`=?",
        [$name, $email, password_hash($password, PASSWORD_DEFAULT), $id]
      );
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

  // (D) SEARCH USER
  // @TODO - YOU MIGHT WANT TO ADD YOUR OWN PAGINATION
  function search ($search) {
    return $this->DB->fetchAll(
      "SELECT * FROM `users` WHERE `user_name` LIKE ? OR `user_email` LIKE ?",
      ["%$search%", "%$search%"], "user_id"
    );
  }

  // (E) GET ALL USERS
  // @TODO - YOU MIGHT WANT TO ADD YOUR OWN PAGINATION
  function getAll () {
    return $this->DB->fetchAll(
      "SELECT * FROM `users`", null, "user_id"
    );
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
