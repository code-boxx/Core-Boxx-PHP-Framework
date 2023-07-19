<?php
class Calendar extends Core {
  // (A) SUNDAY FIRST?
  private $sun = true;

  // (B) SAVE EVENT
  function save ($start, $end, $txt, $color, $bg, $id=null) {
    // (B1) START & END DATE CHECK
    if (strtotime($end) < strtotime($start)) {
      $this->error = "End date cannot be earlier than start date";
      return false;
    }

    // (B2) RUN SQL
    $fields = ["evt_start", "evt_end", "evt_text", "evt_color", "evt_bg"];
    $data = [$start, $end, strip_tags($txt), $color, $bg];
    if ($id===null) { $this->DB->insert("events", $fields, $data); }
    else {
      $data[] = $id;
      $this->DB->update("events", $fields, "`evt_id`=?", $data);
    }
    return true;
  }

  // (C) DELETE EVENT
  function del ($id) {
    $this->DB->delete("events", "`evt_id`=?", [$id]);
    return true;
  }

  // (D) GET EVENT
  function get ($id) {
    return $this->DB->fetch(
      "SELECT * FROM `events` WHERE `evt_id`=?", [$id]
    );
  }

  // (E) GET DATES & EVENTS FOR SELECTED PERIOD
  function getPeriod ($month, $year) {
    // (E1) DATE RANGE CALCULATIONS
    $month = $month<10 ? "0$month" : $month ;
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dateYM = "{$year}-{$month}-";
    $start = $dateYM . "01 00:00:00";
    $end = $dateYM . $daysInMonth . " 23:59:59";

    // (E2) GET EVENTS
    // s & e : start & end date
    // c & b : text & background color
    // t : event text
    $this->DB->query("SELECT * FROM `events` WHERE (
      (`evt_start` BETWEEN ? AND ?)
      OR (`evt_end` BETWEEN ? AND ?)
      OR (`evt_start` <= ? AND `evt_end` >= ?)
    )", [$start, $end, $start, $end, $start, $end]);
    $events = [];
    while ($r = $this->DB->stmt->fetch()) {
      $events[$r["evt_id"]] = [
        "s" => $r["evt_start"], "e" => $r["evt_end"],
        "c" => $r["evt_color"], "b" => $r["evt_bg"],
        "t" => $r["evt_text"]
      ];
    }

    // (E3) RESULTS
    return count($events)==0 ? null : $events ;
  }
}