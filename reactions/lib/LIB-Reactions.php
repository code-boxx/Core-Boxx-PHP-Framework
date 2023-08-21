<?php
class Reactions extends Core {
  // (A) GET REACTIONS FOR ID
  //  $id : content id - video, product, comment, audio, whatever
  function get ($id) {
    // (A1) GET TOTAL REACTIONS
    $data = ["react" => [], "user" => null];
    $this->DB->query(
      "SELECT `reaction`, COUNT(`reaction`) `total`
       FROM `reactions` WHERE `id`=?
       GROUP BY `reaction`", [$id]
    );
    while ($r = $this->DB->stmt->fetch()) {
      $data["react"][$r["reaction"]] = $r["total"];
    }

    // (A2) GET REACTION BY USER (IF SIGNED IN)
    if (isset($_SESSION["user"])) {
      $data["user"] = $this->DB->fetchCol(
        "SELECT `reaction` FROM `reactions` WHERE `id`=? AND `user_id`=?",
        [$id, $_SESSION["user"]["user_id"]]
      );
    }

    // (A3) DONE - RETURN RESULTS
    return $data;
  }

  // (B) SAVE REACTION
  //  $id : content id - video, product, comment, audio, whatever
  //  $reaction : 0 none (delete reaction), 1 dislike, 2 like
  //  $get : get update reaction count after save?
  function save ($id, $reaction, $get=false) {
    // (B1) MUST BE SIGNED IN
    if (!isset($_SESSION["user"])) {
      $this->error = "Please sign in first.";
      return false;
    }

    // (B2) UPDATE REACTION
    if ($reaction == 0) {
      $this->DB->delete("reactions",
        "`id`=? AND `user_id`=?", [$id, $_SESSION["user"]["user_id"]]
      );
    } else {
      $this->DB->replace("reactions",
        ["id", "user_id", "reaction"], [$id, $_SESSION["user"]["user_id"], $reaction]
      );
    }

    // (B3) RESULT
    return $get ? $this->get($id) : true ;
  }
}