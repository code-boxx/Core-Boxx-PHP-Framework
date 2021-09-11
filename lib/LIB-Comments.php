<?php
class Comments extends Core {
  // (A) SAVE COMMENT
  function save ($uid, $id, $message, $cid=null) {
    // @TODO - CHECK IF REGISTERED USER?
    // @TODO - ONLY ALLOW USER TO UPDATE OWN POST (OR ADMIN)
    // if (!isset($_SESSION["user"])) { return false; }

    // (A1) DATA SETUP
    $fields = ["user_id", "id", "message"];
    $data = [$uid, $id, htmlentities($message)];

    // (A2) ADD COMMENT
    if ($cid===null) {
      return $this->DB->insert("comments", $fields, $data);
    }

    // (A3) UPDATE COMMENT
    else {
      $data[] = $cid;
      return $this->DB->update("comments", $fields, "`comment_id`=?", $data);
    }
  }

  // (B) DELETE COMMENT
  function del ($cid) {
    // @TODO - CHECK/ALLOW DELETE ONLY IF USER DELETING OWN POST? (OR ADMIN)
    return $this->DB->query("DELETE FROM `comments` WHERE `comment_id`=?", [$cid]);
  }

  // (C) COUNT COMMENTS (FOR PAGINATION)
  function count ($id) {
    return $this->DB->fetchCol(
      "SELECT COUNT(*) FROM `comments` WHERE `id`=?", [$id]
    );
  }

  // (D) GET COMMENTS
  function get ($id, $page=1) {
    // (D1) PAGINATION
    $entries = $this->count($id);
    $pgn = $this->core->paginator($entries, $page);

    // (D2) GET COMMENTS
    $entries = $this->DB->fetchAll(
      "SELECT c.*, u.`user_name`
       FROM `comments` c
       JOIN `users` u USING (`user_id`)
       WHERE `id`=?
       ORDER BY `timestamp` DESC
       LIMIT {$pgn['x']}, {$pgn['y']}",
      [$id]
    );

    return [
      "data" => $this->DB->fetchAll(
        "SELECT c.*, u.`user_name`
         FROM `comments` c
         JOIN `users` u USING (`user_id`)
         WHERE c.`id`=?
         ORDER BY `timestamp` DESC
         LIMIT {$pgn['x']}, {$pgn['y']}",
        [$id]
      ),
      "page" => $pgn
    ];
  }
}
