<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Contents.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (C) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-content.php");
} catch (Exception $ex) {
  exit("Unable to delete install-content.php, please do so manually.");
}

// (D) DONE
echo "Dynamic Content module successfully installed.";