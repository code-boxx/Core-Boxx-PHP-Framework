<?php
class Reacts extends Core {
  // (A) GET REACTIONS FOR ID
  //  $id : content id - video, product, comment, audio, whatever
  //  $uid : current user id, if any
  function get ($id, $uid=null) {
    // (A1) GET TOTAL REACTIONS
    $results = ["react"=>[]];
    $this->DB->query(
      "SELECT `reaction`, COUNT(`reaction`) `total`
       FROM `reactions` WHERE `id`=?
       GROUP BY `reaction`", [$id]
    );
    while ($row = $this->DB->stmt->fetch()) {
      $results["react"][$row["reaction"]] = $row["total"];
    }

    // (A2) GET REACTION BY USER (IF SPECIFIED)
    if ($uid != null) {
      $results["user"] = $this->DB->fetchCol(
        "SELECT `reaction` FROM `reactions` WHERE `id`=? AND `user_id`=?",
        [$id, $uid]
      );
    }
    return $results;
  }

  // (B) SAVE REACTION
  //  $id : content id - video, product, comment, audio, whatever
  //  $uid : current user id
  //  $reaction : 1 like, -1 dislike, 0 neutral
  function save ($id, $uid, $reaction) {
    // (B1) NEUTRAL REACT
    if ($reaction === 0) {
      $this->DB->delete("reactions",
        "`id`=? AND `user_id`=?", [$id, $uid]
      );
    }

    // (B2) UPDATE REACTION
    else {
      $this->DB->replace("reactions",
        ["id", "user_id", "reaction"], [$id, $uid, $reaction]
      );
    }
    return true;
  }
}
