<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Contents.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (C) UPDATE HOOK-ROUTES.PHP
try {
  // (C1) SIMPLE CHECKS
  require PATH_LIB . "HOOK-Routes.php";
  if (!isset($wild)) {
    exit("Please define \$wild=[] in HOOK-Routes.php");
  }
  $wild = count($wild);
  unset($routes); unset($override);

  // (C2) BACKUP & READ HOOK-ROUTES.PHP
  copy(PATH_LIB . "HOOK-Routes.php", PATH_LIB . "HOOK-Routes.old");
  $cfg = file(PATH_LIB . "HOOK-Routes.php");

  // (C3) INSERT NEW POSTS ROUTE
  $add = <<<EOF
    "post/" => "POST-load.php"
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

// (D) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-content.php");
} catch (Exception $ex) {
  exit("Unable to delete install-content.php, please do so manually.");
}

// (E) DONE
echo "Dynamic Content module successfully installed.";