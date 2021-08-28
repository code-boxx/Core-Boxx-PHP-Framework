<?php
class Comments extends Core {
  // (A) SAVE COMMENT
  function save ($uid, $id, $message, $cid=null) {
    // (A1) ADD COMMENT
    // @TODO - CHECK IF REGISTERED USER?
    // if (!isset($_SESSION['user'])) { return false; }
    if ($cid===null) {
      return $this->DB->insert("comments",
        ["user_id", "id", "message"],
        [$uid, $id, htmlentities($message)]
      );
    }

    // (A2) UPDATE COMMENT
    // @TODO - ONLY ALLOW USER TO UPDATE OWN POST (OR ADMIN)
    else {
      return $this->DB->update("comments",
        ["user_id", "id", "message"],
        "`comment_id`=?",
        [$uid, $id, htmlentities($message), $cid]
      );
    }
  }

  // (B) DELETE COMMENT
  function del ($cid) {
    // @TODO - CHECK/ALLOW DELETE ONLY IF USER DELETING OWN POST? (OR ADMIN)
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
