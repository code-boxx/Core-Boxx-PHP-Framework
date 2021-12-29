<?php
class Comments extends Core {
  // (A) SAVE COMMENT
  //  $id : content id - post, product, video, whatever you are attaching comments to
  //  $message : the message
  //  $cid : comment id, for updating only
  function save ($id, $message, $cid=null) {
    // (A1) CHECK USER
    global $_SESS;
    if (!isset($_SESS["user"])) {
      $this->error = "Please sign in first.";
      return false;
    }

    // (A2) DATA SETUP
    $fields = ["user_id", "id", "message"];
    $data = [$_SESS["user"]["user_id"], $id, htmlentities($message)];

    // (A3) ADD/UPDATE COMMENT
    if ($cid==null) {
      $this->DB->insert("comments", $fields, $data);
    } else {
      $data[] = $cid;
      $this->DB->update("comments", $fields, "`comment_id`=?", $data);
    }
    return true;
  }

  // (B) DELETE COMMENT
  //  $cid : comment id
  function del ($cid) {
    // (B1) MUST BE SIGNED IN
    global $_SESS;
    if (!isset($_SESS["user"])) {
      $this->error = "Please sign in first.";
      return false;
    }

    // (B2) GET COMMENT
    $comment = $this->get($cid);

    // (B3) CAN ONLY DELETE OWN COMMENT
    // @TODO - ADD YOUR OWN CHANGES - ALLOW ADMIN TO DELETE
    if ($comment["user_id"]!=$_SESS["user"]["user_id"]) {
      $this->error = "You don't have permissions to delete this comment.";
      return false;
    }

    // (B4) OK - DELETE
    $this->DB->delete("comments", "`comment_id`=?", [$cid]);
  }

  // (C) GET COMMENT
  //  $cid : comment id
  function get ($cid) {
    return $this->DB->fetch(
      "SELECT * FROM `comments` WHERE `comment_id`=?", [$cid]
    );
  }

  // (D) GET ALL COMMENTS
  function getAll ($id, $page=null) {
    // (D1) SQL & DATA
    $sql = "SELECT c.`comment_id`, c.`timestamp`, c.`message`, u.`user_name`, u.`user_id`
     FROM `comments` c
     JOIN `users` u USING (`user_id`)
     WHERE `id`=?
     ORDER BY `timestamp` DESC";
    $data = [$id];

    // (D2) PAGINATION
    if ($page != null) {
      $pgn = $this->core->paginator(
        $this->DB->fetchCol(
          "SELECT COUNT(*) FROM `comments` WHERE `id`=?", [$id]
        ), $page
      );
      $sql .= " LIMIT {$pgn["x"]}, {$pgn["y"]}";
    }

    // (D3) RESULTS
    $comments = $this->DB->fetchAll($sql, $data, "comment_id");
    return $page != null
     ? ["data" => $comments, "page" => $pgn]
     : $comments ;
  }
}
