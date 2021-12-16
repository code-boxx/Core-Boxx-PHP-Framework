<?php
// RUN THIS AFTER YOU HAVE UPDATED SETTINGS IN LIB/GO.PHP
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "GO.php";
$_CORE->load("Route");
echo $_CORE->Route->init()
  ? "GOOD TO GO! Delete this script."
  : "ERROR!" ;
