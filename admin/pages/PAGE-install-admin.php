<?php
// (A) NEED USERS MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) PROCEED WITH INSTALLATION
if (isset($_POST["go"])) {
  // (B1) UPDATE CORE-CONFIG.PHP - INSERT HOST_ADMIN DEFINITION
  $_CORE->load("MInstall");
  $_CORE->MInstall->insert(
    PATH_LIB . "CORE-Config.php", "HOST_ASSETS",
    'define("HOST_ADMIN", HOST_BASE . "admin/"); // ADDED BY INSTALLER' . "\r\n"
  );

  // (B2) UPDATE HOOK-ROUTES.PHP
  // (B2-1) SIMPLE CHECK
  require PATH_LIB . "HOOK-Routes.php";
  if (!isset($wild)) { exit("Please define \$wild=[] in HOOK-Routes.php"); }
  $wild = count($wild);
  unset($routes); unset($override);

  // (B2-2) INSERT ADMIN ROUTE
  $_CORE->MInstall->insert(
    PATH_LIB . "HOOK-Routes.php", "\$wild",
    '  "admin/" => "ADM-check.php"' .
    ($wild==0 ? "" : ",") .
    " // ADDED BY INSTALLER\r\n"
  );

  // (B3) CREATE ADMIN ACCOUNT
  $_CORE->load("Users");
  $_CORE->Users->save($_POST["name"], $_POST["email"], $_POST["pass"], "A");
  
  // (B4) CLEAN UP
  $_CORE->MInstall->clean("admin"); exit();
}

// (C) ENTER ADMIN USER/PASSWORD
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="my-4">CREATE A NEW ADMIN ACCOUNT</h3>
<form method="post">
  <div class="form-floating mb-4">
    <input type="text" name="name" class="form-control" required value="Admin">
    <label>Name</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" name="email" class="form-control" required value="admin@site.com">
    <label>Email</label>
  </div>

  <div class="form-floating mb-4">
    <input type="password" name="pass" class="form-control" required value="ABC12345">
    <label>Password</label>
  </div>

  <input type="hidden" name="go" value="1">
  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-checkmark"></i> Install
  </button>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>