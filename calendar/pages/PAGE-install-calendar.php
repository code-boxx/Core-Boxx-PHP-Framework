<?php
// (A) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-Calendar.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (B) DELETE THIS SCRIPT
try {
  unlink(PATH_PAGES . "PAGE-install-calendar.php");
} catch (Exception $ex) {
  exit("Unable to delete PAGE-install-calendar.php, please do so manually.");
}

// (C) DONE
exit("Calendar module successfully installed.");