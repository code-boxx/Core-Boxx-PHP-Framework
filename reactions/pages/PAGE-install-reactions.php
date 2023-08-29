<?php
// (A) CHECK - USERS MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Reactions.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (C) DELETE THIS SCRIPT
try {
  unlink(PATH_PAGES . "PAGE-install-reactions.php");
} catch (Exception $ex) {
  exit("Unable to delete PAGE-install-reactions.php, please do so manually.");
}

// (D) DONE
exit("Reactions module successfully installed.");