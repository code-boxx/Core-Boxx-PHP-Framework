<?php
class Reacts extends Core {
  // (A) GET REACTIONS FOR ID
  function get ($id, $uid=null) {
    // (A1) GET TOTAL REACTIONS
    $results = ["react"=>[]];
    if(!$this->DB->query(
      "SELECT `reaction`, COUNT(`reaction`) `total`
      FROM `reactions` WHERE `id`=?
      GROUP BY `reaction`", [$id]
    )) { return false; }
    while ($row = $this->DB->stmt->fetch()) {
      $results["react"][$row["reaction"]] = $row["total"];
    }

    // (A2) GET REACTION BY USER (IF SPECIFIED)
    if ($uid !== null) {
      $results["user"] = $this->DB->fetchCol(
        "SELECT `reaction` FROM `reactions` WHERE `id`=? AND `user_id`=?",
        [$id, $uid]
      );
      if ($results["user"]===false) { return false; }
    }
    return $results;
  }

  // (B) SAVE REACTION
  function save ($id, $uid, $reaction) {
    // (B1) FORMULATE SQL
    if ($reaction == 0) {
      $sql = "DELETE FROM `reactions` WHERE `id`=? AND `user_id`=?";
      $data = [$id, $uid];
    } else {
      $sql = "REPLACE INTO `reactions` (`id`, `user_id`, `reaction`) VALUES (?,?,?)";
      $data = [$id, $uid, $reaction];
    }

    // (B2) EXECUTE SQL
    return $this->DB->query($sql, $data);
  }
}
