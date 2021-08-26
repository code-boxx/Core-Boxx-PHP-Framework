<?php
class Reacts extends Core {
  // (A) GET REACTIONS FOR ID
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
    if ($uid !== null) {
      $this->DB->query("SELECT `reaction` FROM `reactions` WHERE `id`=? AND `user_id`=?", [$id, $uid]);
      $results["user"] = $this->DB->stmt->fetchColumn();
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
