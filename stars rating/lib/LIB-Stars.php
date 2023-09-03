<?php
class Stars extends Core {
  // (A) GET ALL STAR RATINGS
  //  $page : optional, current page number
  function getAll ($page=null) {
    // (A1) SQL
    $sql = "SELECT `id`, ROUND(AVG(`rating`), 2) `avg`, COUNT(`user_id`) `num`
            FROM `star_rating` GROUP BY `id`";

    // (A2) PAGINATION
    if ($page != null) {
      $this->Core->paginator(
        $this->DB->fetchCol("SELECT COUNT(DISTINCT `id`) FROM `star_rating`", $data), $page
      );
      $sql .= $this->Core->page["lim"];
    }

    // (A3) GET DATA
    $stars = [];
    $this->DB->query($sql);
    while ($r = $this->DB->stmt->fetch()) {
      $stars[$r["id"]] = [
        "avg" => $r["avg"],
        "num" => $r["num"]
      ];
    }

    // (A4) ALSO GET THE USER'S RATING FOR THE ID
    if (isset($_SESSION["user"])) {
      $this->DB->query(
        "SELECT `id`, `rating` FROM `star_rating` WHERE `user_id`=?",
        [$_SESSION["user"]["user_id"]]
      );
      while ($r = $this->DB->stmt->fetch()) {
        $stars[$r["id"]]["user"] = $r["rating"];
      }
    }

    // (A5) RETURN RESULTS
    return $stars;
  }

  // (B) GET STARS RATING FOR ID
  function get ($id) {
    // (B1) AVERAGE STARS RATING
    $rate = $this->DB->fetch(
      "SELECT ROUND(AVG(`rating`), 2) `avg`, COUNT(`user_id`) `num`
       FROM `star_rating` WHERE `id`=?", [$id]
    );
    if ($rate["avg"]==null || $rate["avg"]=="") { $rate["avg"] = 0; }
    if ($rate["num"]==null || $rate["num"]=="") { $rate["num"] = 0; }

    // (B2) ALSO GET THE USER'S RATING FOR THE ID
    if (isset($_SESSION["user"])) {
      $rate["user"] = $this->DB->fetchCol(
        "SELECT `rating` FROM `star_rating` WHERE `user_id`=? AND `id`=?",
        [$_SESSION["user"]["user_id"], $id]
      );
    }

    // (B3) RETURN THE RATING
    return $rate;
  }

  // (C) SAVE/UPDATE STAR RATING
  function save ($id, $stars) {
    $this->DB->query(
      "REPLACE INTO `star_rating` (`id`, `user_id`, `rating`) VALUES (?,?,?)",
      [$id, $_SESSION["user"]["user_id"], $stars]
    );
    return true;
  }
}