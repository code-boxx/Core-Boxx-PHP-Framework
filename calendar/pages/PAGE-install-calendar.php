<?php
// (A) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Calendar.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (B) CLEAN UP
$_CORE->load("MInstall");
$_CORE->MInstall->clean("calendar");