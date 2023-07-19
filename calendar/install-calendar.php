<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Calendar.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (C) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-calendar.php");
} catch (Exception $ex) {
  exit("Unable to delete install-calendar.php, please do so manually.");
}

// (D) DONE
echo "Calendar module successfully installed.";