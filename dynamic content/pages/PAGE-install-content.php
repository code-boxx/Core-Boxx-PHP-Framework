<?php
// (A) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Contents.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (B) UPDATE HOOK-ROUTES.PHP
try {
  // (B1) SIMPLE CHECKS
  require PATH_LIB . "HOOK-Routes.php";
  if (!isset($wild)) {
    exit("Please define \$wild=[] in HOOK-Routes.php");
  }
  $wild = count($wild);
  unset($routes); unset($override);

  // (B2) BACKUP & READ HOOK-ROUTES.PHP
  copy(PATH_LIB . "HOOK-Routes.php", PATH_LIB . "HOOK-Routes.old");
  $cfg = file(PATH_LIB . "HOOK-Routes.php");

  // (B3) INSERT NEW POSTS ROUTE
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

// (C) DELETE THIS SCRIPT
try {
  unlink(PATH_PAGES . "PAGE-install-content.php");
} catch (Exception $ex) {
  exit("Unable to delete PAGE-install-content.php, please do so manually.");
}

// (D) DONE
exit("Dynamic Content module successfully installed.");