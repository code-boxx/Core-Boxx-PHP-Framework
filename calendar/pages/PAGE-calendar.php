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
<div id="calPeriod">
  <select id="calMonth"><?php foreach ($months as $m=>$mth) {
    printf("<option value='%u'%s>%s</option>",
      $m, $m==$monthNow?" selected":"", $mth
    );
  } ?></select>
  <input id="calYear" type="number" value="<?=$yearNow?>">
  <input id="calAdd" type="button" value="+">
</div>

<!-- (B2) CALENDAR WRAPPER -->
<div id="calWrap"></div>

<!-- (B3) EVENT FORM -->
<div id="calForm"><form>
  <input type="hidden" id="evtID">

  <div class="input-group my-3">
    <div class="input-group-prepend">
      <span class="input-group-text mi">today</span>
    </div>
    <input id="evtStart" type="datetime-local" class="form-control" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text mi">event</span>
    </div>
    <input id="evtEnd" type="datetime-local" class="form-control" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text mi">article</span>
    </div>
    <input id="evtTxt" type="text" class="form-control" required placeholder="Event">
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text mi">format_color_text</span>
    </div>
    <input id="evtColor" type="color" class="form-control form-control-color" value="#000000" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text mi">format_color_fill</span>
    </div>
    <input id="evtBG" type="color" class="form-control form-control-color" value="#ffdbdb" required>
  </div>

  <div class="d-flex">
    <input type="button" id="evtCX" class="btn btn-danger me-2" value="Cancel">
    <input type="button" id="evtDel" class="btn btn-danger me-2" value="Delete">
    <input type="submit" id="evtSave" class="btn btn-primary" value="Save">
  </div>
</form></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>