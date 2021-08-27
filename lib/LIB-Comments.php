<?php
class Comments extends Core {
  // (A) SAVE COMMENT
  function save ($uid, $id, $message, $cid=null) {
    // (A1) ADD COMMENT
    if ($cid===null) {
      return $this->DB->insert("comments",
        ["user_id", "id", "message"],
        [$uid, $id, $message]
      );
    }
    // (A2) UPDATE COMMENT
    else {
      return $this->DB->update("comments",
        ["user_id", "id", "message"],
        "`comment_id`=?",
        [$uid, $id, $message, $cid]
      );
    }
  }

  // (B) DELETE COMMENT
  function del ($cid) {
    return $this->DB->query("DELETE FROM `comments` WHERE `comment_id`=?", [$cid]);
  }

  // (C) GET COMMENTS
  function get ($id) {
    return $this->DB->fetchAll(
      "SELECT c.*, u.`user_name`
       FROM `comments` c
       JOIN `users` u USING (`user_id`)
       WHERE `id`=?
       ORDER BY `timestamp` DESC",
      [$id]
    );
  }
}
