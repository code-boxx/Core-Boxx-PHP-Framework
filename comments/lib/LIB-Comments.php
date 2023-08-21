<?php
class Comments extends Core {
  // (A) GET ALL COMMENTS
  //  $id : content id - post, product, video, whatever you are attaching comments to
  //  $page : page number, optional
  function getAll ($id, $page=null) {
    // (A1) SQL & DATA
    $sql = "SELECT c.`comment_id`, c.`timestamp`, c.`message`, u.`user_name`, u.`user_id`
     FROM `comments` c
     JOIN `users` u USING (`user_id`)
     WHERE `id`=?
     ORDER BY `timestamp` DESC";
    $data = [$id];

    // (A2) PAGINATION
    if ($page != null) {
      $this->Core->paginator($this->DB->fetchCol(
        "SELECT COUNT(*) FROM `comments` WHERE `id`=?", [$id]
      ), $page);
      $sql .= $this->Core->page["lim"];
    }

    // (A3) RESULTS
    return $this->DB->fetchAll($sql, $data, "comment_id");
  }

  // (B) GET COMMENT
  //  $cid : comment id
  function get ($cid) {
    return $this->DB->fetchAll("SELECT * FROM `comments` WHERE `comment_id`=?", [$cid]);
  }

  // (C) HELPER - CHECK USER
  //  $cid : comment id for edit/delete, user can only edit/delete own comments
  function check ($cid=null) {
    // (C1) MUST BE SIGNED IN
    if (!isset($_SESSION["user"])) {
      $this->error = "Please sign in first.";
      return false;
    }

    // (C2) FOR EDIT/DELETE - CHECK IF OWN COMMENT
    if ($cid!=null && $_SESSION["user"]["user_level"]!="A") {
      $comment = $this->get($cid);
      if (!isset($comment["user_id"]) || $comment["user_id"]!=$_SESSION["user"]["user_id"]) {
        $this->error = "Invalid comment";
        return false;
      }
    }

    // (C3) OK
    return true;
  }

  // (D) SAVE COMMENT
  //  $message : the message
  //  $id : content id - post, product, video, whatever you are attaching comments to
  //  $uid : user id
  //  $cid : comment id, for updating only
  function save ($message, $id, $uid, $cid=null) {
    // (D1) DATA SETUP
    $fields = ["message", "id", "user_id"];
    $data = [htmlentities($message), $id, $uid];

    // (D2) ADD/UPDATE COMMENT
    if ($cid==null) {
      $this->DB->insert("comments", $fields, $data);
    } else {
      $data[] = $cid;
      $this->DB->update("comments", $fields, "`comment_id`=?", $data);
    }
    return true;
  }

  // (E) SAVE COMMENT (WITH CHECK)
  //  $message : the message
  //  $id : content id - post, product, video, whatever you are attaching comments to
  //  $cid : comment id, for updating only
  function savewc ($message, $id, $cid=null) {
    if (!$this->check($cid)) { return false; }
    $this->save($message, $id, $_SESSION["user"]["user_id"], $cid);
    return true;
  }

  // (F) DELETE COMMENT
  //  $cid : comment id
  function del ($cid) {
    $this->DB->delete("comments", "`comment_id`=?", [$cid]);
    return true;
  }

  // (G) DELETE COMMENT (WITH CHECK)
  //  $cid : comment id
  function delwc ($cid) {
    if (!$this->check($cid)) { return false; }
    $this->DB->delete("comments", "`comment_id`=?", [$cid]);
    return true;
  }
}