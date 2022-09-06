<?php
// (A) CONFIG + CORE + DEFAULT MODULES
require __DIR__ . DIRECTORY_SEPARATOR . "CORE-Config.php";
require PATH_LIB . "LIB-Core.php";
$_CORE->load("DB");
$_CORE->load("Settings");
// $_CORE->load("Session"); // ENABLE THIS IF USING USER MODULE

// (B) LOAD MODULES AS REQUIRED