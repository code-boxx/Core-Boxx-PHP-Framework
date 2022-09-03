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
    $data = [$start, $end, $txt, $color, $bg];
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
    // (E1) DATA STRUCTURE
    $cells = []; // "b" blank cell
                 // "d" day number
                 // "t" today
                 // "e" => [event ids]
    $events = []; // event id => data
    $map = []; // "yyyy-mm-dd" => $cells[n]

    // (E2) DATE RANGE CALCULATIONS
    $month = $month<10 ? "0$month" : $month ;
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $dateYM = "{$year}-{$month}-";
    $dateFirst = $dateYM . "01";
    $dateLast = $dateYM . $daysInMonth;
    $dayFirst = (new DateTime($dateFirst))->format("w");
    $dayLast = (new DateTime($dateLast))->format("w");
    $nowDay = (date("n")==$month && date("Y")==$year) ? date("j") : 0 ;

    // (E3) PAD EMPTY CELLS BEFORE FIRST DAY OF MONTH
    if ($this->sun) { $pad = $dayFirst; }
    else { $pad = $dayFirst==0 ? 6 : $dayFirst-1 ; }
    for ($i=0; $i<$pad; $i++) { $cells[] = ["b" => 1]; }

    // (E4) DAYS IN MONTH
    for ($day=1; $day<=$daysInMonth; $day++) {
      $i = count($cells);
      $map["$year-$month-".($day<10?"0$day":$day)] = $i;
      $cells[] = ["d" => $day];
      if ($day == $nowDay) { $cells[$i]["t"] = 1; }
    }

    // (E5) PAD EMPTY CELLS AFTER LAST DAY OF MONTH
    if ($this->sun) { $pad = $dayLast==0 ? 6 : 6-$dayLast ; }
    else { $pad = $dayLast==0 ? 0 : 7-$dayLast ; }
    for ($i=0; $i<$pad; $i++) { $cells[] = ["b" => 1]; }

    // (E6) GET EVENTS
    $start = "$dateFirst 00:00:00";
    $end = "$dateLast 23:59:59";
    $this->DB->query("SELECT * FROM `events` WHERE (
      (`evt_start` BETWEEN ? AND ?)
      OR (`evt_end` BETWEEN ? AND ?)
      OR (`evt_start` <= ? AND `evt_end` >= ?)
    )", [$start, $end, $start, $end, $start, $end]);
    while ($r = $this->DB->stmt->fetch()) {
      // (E6-1) "SAVE" $EVENTS DETAILS
      $events[$r["evt_id"]] = [
        "s" => $r["evt_start"], "e" => $r["evt_end"],
        "c" => $r["evt_color"], "b" => $r["evt_bg"],
        "t" => $r["evt_text"]
      ];

      // (E6-2) "MAP" EVENTS TO $CELLS
      $start = substr($r["evt_start"], 5, 2)==$month ? (int)substr($r["evt_start"], 8, 2) : 1 ;
      $end = substr($r["evt_end"], 5, 2)==$month ? (int)substr($r["evt_end"], 8, 2) : 1 ;
      for ($d=$start; $d<=$end; $d++) {
        $eday = $dateYM . ($d<10?"0$d":$d);
        if (!isset($cells[$map[$eday]]["e"])) { $cells[$map[$eday]]["e"] = []; }
        $cells[$map[$eday]]["e"][] = $r["evt_id"];
      }
    }

    // (E7) RESULTS
    return ["s"=>$this->sun, "e" => $events, "c" => $cells];
  }
}