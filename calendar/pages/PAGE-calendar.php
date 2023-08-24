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
<div id="calHead" class="d-flex align-items-stretch p-2">
  <div id="calPeriod" class="d-flex align-items-stretch flex-grow-1">
    <button type="button" id="calBack" class="p-2 me-2 ico icon-circle-left"></button>
    <select id="calMonth" class="p-2 me-2"><?php foreach ($months as $m=>$mth) {
      printf("<option value='%u'%s>%s</option>",
        $m, $m==$monthNow?" selected":"", $mth
      );
    } ?></select>
    <input id="calYear" class="p-2 me-2" type="number" value="<?=$yearNow?>">
    <button type="button" id="calNext" class="p-2 ico icon-circle-right"></button>
  </div>
  <button type="button" id="calAdd" class="p-2 ico-sm icon-plus"></button>
</div>

<!-- (B2) CALENDAR WRAPPER -->
<div id="calWrap">
  <div id="calDays"></div>
  <div id="calBody"></div>
</div>

<!-- (B3) EVENT FORM -->
<dialog id="calForm"><form method="dialog">
  <div id="evtCX" class="ico icon-cross p-3"></div>
  <h4 class="w-100 mb-4">CALENDAR EVENT</h4>
  <input type="hidden" id="evtID">

  <div class="w-50 p-1 form-floating">
    <input id="evtStart" class="form-control" type="datetime-local" required>
    <label>Start</label>
  </div>

  <div class="w-50 p-1 form-floating">
    <input id="evtEnd" class="form-control" type="datetime-local" required>
    <label>End</label>
  </div>

  <div class="w-50 p-1 form-floating">
    <input id="evtColor" class="form-control" type="color" value="#000000" required>
    <label>Text Color</label>
  </div>

  <div class="w-50 p-1 form-floating">
    <input id="evtBG" class="form-control" type="color" value="#ffdbdb" required>
    <label>Background Color</label>
  </div>

  <div class="w-100 p-1 form-floating">
    <input id="evtTxt" class="form-control" type="text" required>
    <label>Event</label>
  </div>

  <div class="w-100 mt-2">
    <button type="button" id="evtDel" class="my-1 btn btn-danger d-flex-inline">
      <i class="ico-sm icon-bin2 me-1"></i> Delete
    </button>
    <button type="submit" id="evtSave" class="my-1 btn btn-primary d-flex-inline">
      <i class="ico-sm icon-checkmark me-1"></i> Save
    </button>
  </div>
</form></dialog>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>