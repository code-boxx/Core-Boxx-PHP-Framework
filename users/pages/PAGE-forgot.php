<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect(); }

// (B) PART 1 - ENTER EMAIL
if (!isset($_GET["i"]) && !isset($_GET["h"])) {
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-forgot.js"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<form class="bg-white border p-4" onsubmit="return forgot()">
  <h3 class="mb-4">FORGOT PASSWORD</h3>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">email</span>
    </div>
    <input type="email" id="forgot-email" class="form-control" required placeholder="Email">
  </div>

  <input type="submit" class="btn btn-primary" value="Reset Request">
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; }

// (C) PART 2 - VALIDATION
else {
$_CORE->load("Forgot");
$pass = $_CORE->Forgot->reset($_GET["i"], $_GET["h"]);
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="bg-white border p-4">
  <h3 class="mb-4"><?=$pass?"DONE!":"OOOOOPPPSSSSSS...."?></h3>
  <div><?php
    if ($pass) { echo "OK - New password sent to your email."; }
    else { echo $_CORE->error; }
  ?></div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; } ?>