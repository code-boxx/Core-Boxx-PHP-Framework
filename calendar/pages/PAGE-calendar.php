<?php
// (A) DAYS MONTHS YEAR
$months = [
  1 => "January", 2 => "Febuary", 3 => "March", 4 => "April",
  5 => "May", 6 => "June", 7 => "July", 8 => "August",
  9 => "September", 10 => "October", 11 => "November", 12 => "December"
];
$monthNow = date("m");
$yearNow = date("Y");

// (B) HTML PAGE
$_PMETA = [
  "title" => "Core Boxx Calendar Demo",
  "load" => [
    ["c", HOST_ASSETS."PAGE-calendar.css"],
    ["s", HOST_ASSETS."PAGE-calendar.js", "defer"]
  ]
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B1) PERIOD SELECTOR -->
<div id="calHead">
  <div id="calPeriod">
    <select id="calMonth"><?php foreach ($months as $m=>$mth) {
      printf("<option value='%u'%s>%s</option>",
        $m, $m==$monthNow?" selected":"", $mth
      );
    } ?></select>
    <input id="calYear" type="number" value="<?=$yearNow?>">
  </div>
  <input id="calAdd" type="button" value="+">
</div>

<!-- (B2) CALENDAR WRAPPER -->
<div id="calWrap">
  <div id="calDays"></div>
  <div id="calBody"></div>
</div>

<!-- (B3) EVENT FORM -->
<dialog id="calForm"><form method="dialog">
  <div id="evtCX" class="mi">clear</div>
  <h2 class="evt100">CALENDAR EVENT</h2>
  <div class="evt50">
    <label>Start</label>
    <input id="evtStart" type="datetime-local" required>
  </div>
  <div class="evt50">
    <label>End</label>
    <input id="evtEnd" type="datetime-local" required>
  </div>
  <div class="evt50">
    <label>Text Color</label>
    <input id="evtColor" type="color" value="#000000" required>
  </div>
  <div class="evt50">
    <label>Background Color</label>
    <input id="evtBG" type="color" value="#ffdbdb" required>
  </div>
  <div class="evt100">
    <label>Event</label>
    <input id="evtTxt" type="text" required>
  </div>
  <div class="evt100">
    <input type="hidden" id="evtID">
    <input type="button" id="evtDel" value="Delete">
    <input type="submit" id="evtSave" value="Save">
  </div>
</form></dialog>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>