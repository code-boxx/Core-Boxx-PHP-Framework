<?php
// (A) CONFIG + CORE + DEFAULT MODULES
require __DIR__ . DIRECTORY_SEPARATOR . "CORE-Config.php";
require PATH_LIB . "LIB-Core.php";
$_CORE->load("DB");
$_CORE->load("Settings");

// (B) LOAD MODULES AS REQUIRED
$_CORE->load("Session");