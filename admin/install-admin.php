<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) NEED USERS MODULE
if (!file_exists(PATH_LIB . "LIB-Users.php")) {
  exit("Please install the users module first.");
}

// (C) UPDATE CORE-CONFIG.PHP
try {
  // (C1) BACKUP & READ CORE-CONFIG.PHP
  copy(PATH_LIB . "CORE-Config.php", PATH_LIB . "CORE-Config.old");
  $cfg = file(PATH_LIB . "CORE-Config.php");

  // (C2) INSERT NEW HOST_ADMIN DEFINITION
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

// (D) UPDATE HOOK-ROUTES.PHP
try {
  // (D1) SIMPLE CHECKS
  require PATH_LIB . "HOOK-Routes.php";
  if (!isset($wild)) {
    exit("Please define \$wild=[] in HOOK-Routes.php");
  }
  $wild = count($wild);
  unset($routes); unset($override);

  // (D2) BACKUP & READ HOOK-ROUTES.PHP
  copy(PATH_LIB . "HOOK-Routes.php", PATH_LIB . "HOOK-Routes.old");
  $cfg = file(PATH_LIB . "HOOK-Routes.php");

  // (D3) INSERT NEW ADMIN ROUTE
  $add = <<<EOF
    "admin/" => "ADM-check.php" // ADDED BY INSTALLER
  EOF;
  $at = 0;
  foreach ($cfg as $l=>$line) {
    if (strpos($line, "\$wild = [") !== false) {
      $at = $l; break;
    }
  }
  $at = $at + 1;
  array_splice($cfg, $at, 0, $add . ($wild==0?"":",") . "\r\n");
  file_put_contents(PATH_LIB . "HOOK-Routes.php", implode("", $cfg));
} catch (Exception $ex) {
  exit("Unable to update HOOK-Routes.php - " . $ex->getMessage());
}

// (E) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-admin.php");
} catch (Exception $ex) {
  exit("Unable to delete install-admin.php, please do so manually.");
}

// (F) DONE
echo "Admin module successfully installed.";