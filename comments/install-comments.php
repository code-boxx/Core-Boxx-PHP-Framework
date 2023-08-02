<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) NEED USERS MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (C) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Comments.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (D) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-comments.php");
} catch (Exception $ex) {
  exit("Unable to delete install-comments.php, please do so manually.");
}

// (E) DONE
echo "Comments module successfully installed.";