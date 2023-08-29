<?php
// (A) NEED USERS MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) PROCEED WITH INSTALLATION
if (isset($_POST["go"])) {
  // (B1) UPDATE CORE-CONFIG.PHP
  try {
    // (B1-1) BACKUP & READ CORE-CONFIG.PHP
    copy(PATH_LIB . "CORE-Config.php", PATH_LIB . "CORE-Config.old");
    $cfg = file(PATH_LIB . "CORE-Config.php");
  
    // (B1-2) INSERT NEW HOST_ADMIN DEFINITION
    $add = <<<EOF
    define("HOST_ADMIN", HOST_BASE . "admin/"); // ADDED BY INSTALLER
    EOF;
    $at = 0;
    foreach ($cfg as $l=>$line) {
      if (strpos($line, "(B) API ENDPOINT") !== false) {
        $at = $l; break;
      }
    }
    $at = $at - 1;
    array_splice($cfg, $at, 0, $add . "\r\n");
    file_put_contents(PATH_LIB . "CORE-Config.php", implode("", $cfg));
  } catch (Exception $ex) {
    exit("Unable to update CORE-Config.php - " . $ex->getMessage());
  }
  
  // (B2) UPDATE HOOK-ROUTES.PHP
  try {
    // (B2-1) SIMPLE CHECKS
    require PATH_LIB . "HOOK-Routes.php";
    if (!isset($wild)) {
      exit("Please define \$wild=[] in HOOK-Routes.php");
    }
    $wild = count($wild);
    unset($routes); unset($override);
  
    // (B2-2) BACKUP & READ HOOK-ROUTES.PHP
    copy(PATH_LIB . "HOOK-Routes.php", PATH_LIB . "HOOK-Routes.old");
    $cfg = file(PATH_LIB . "HOOK-Routes.php");
  
    // (B2-3) INSERT NEW ADMIN ROUTE
    $add = <<<EOF
      "admin/" => "ADM-check.php"
    EOF;
    $at = 0;
    foreach ($cfg as $l=>$line) {
      if (strpos($line, "\$wild = [") !== false) {
        $at = $l; break;
      }
    }
    $at = $at + 1;
    array_splice($cfg, $at, 0, $add . ($wild==0?"":",") . " // ADDED BY INSTALLER\r\n");
    file_put_contents(PATH_LIB . "HOOK-Routes.php", implode("", $cfg));
  } catch (Exception $ex) {
    exit("Unable to update HOOK-Routes.php - " . $ex->getMessage());
  }
  
  // (B3) CREATE DUMMY ADMIN
  $_CORE->load("Users");
  $_CORE->Users->save($_POST["name"], $_POST["email"], $_POST["pass"], "A");
  
  // (B4) DELETE THIS SCRIPT
  try {
    unlink(PATH_PAGES . "PAGE-install-admin.php");
  } catch (Exception $ex) {
    exit("Unable to delete PAGE-install-admin.php, please do so manually.");
  }
  
  // (B5) DONE
  exit("Admin module successfully installed.");
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