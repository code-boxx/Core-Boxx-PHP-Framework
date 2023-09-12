<?php
// (A) IMPORT SQL
$_CORE->load("MInstall");
$_CORE->MInstall->sql("Contents");

// (B) UPDATE HOOK-ROUTES.PHP
// (B2-1) SIMPLE CHECK
require PATH_LIB . "HOOK-Routes.php";
if (!isset($wild)) { exit("Please define \$wild=[] in HOOK-Routes.php"); }
$wild = count($wild);
unset($routes); unset($override);

// (B2-2) INSERT CONTENT ROUTE
$_CORE->MInstall->insert(
  PATH_LIB . "HOOK-Routes.php", "\$wild",
  '  "post/" => "POST-load.php"' .
  ($wild==0 ? "" : ",") .
  " // ADDED BY INSTALLER\r\n"
);

// (C) CLEAN UP
$_CORE->MInstall->clean("content");