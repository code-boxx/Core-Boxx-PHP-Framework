<?php
class Reacts extends Core {
  // (A) GET REACTIONS FOR ID
  //  $id : content id - video, product, comment, audio, whatever
  function get ($id) {
    // (A1) GET TOTAL REACTIONS
    $reacts = ["react" => [0, 0]]; // likes, dislikes
    $this->DB->query(
      "SELECT `reaction`, COUNT(`reaction`) `total`
       FROM `reactions` WHERE `id`=?
       GROUP BY `reaction`", [$id]
    );
    while ($r = $this->DB->stmt->fetch()) {
      if ($r["reaction"]==1) { $reacts["react"][0] = $r["total"]; }
      else { $reacts["react"][1] = $r["total"]; }
    }

    // (A2) GET REACTION BY USER (IF SIGNED IN)
    global $_SESS;
    if (isset($_SESS["user"])) {
      $reacts["user"] = $this->DB->fetchCol(
        "SELECT `reaction` FROM `reactions` WHERE `id`=? AND `user_id`=?",
        [$id, $_SESS["user"]["user_id"]]
      );
    }

    // (A3) DONE - RETURN RESULTS
    return $reacts;
  }

  // (B) SAVE REACTION
  //  $id : content id - video, product, comment, audio, whatever
  //  $reaction : 1 like, -1 dislike, 0 neutral
  function save ($id, $reaction) {
    // (B1) MUST BE SIGNED IN
    global $_SESS;
    if (!isset($_SESS["user"])) {
      $this->error = "Please sign in first.";
      return false;
    }

    // (B2) UPDATE REACTION
    if ($reaction == 0) {
      $this->DB->delete("reactions",
        "`id`=? AND `user_id`=?", [$id, $_SESS["user"]["user_id"]]
      );
    } else {
      $this->DB->replace("reactions",
        ["id", "user_id", "reaction"], [$id, $_SESS["user"]["user_id"], $reaction]
      );
    }
    return true;
  }
}