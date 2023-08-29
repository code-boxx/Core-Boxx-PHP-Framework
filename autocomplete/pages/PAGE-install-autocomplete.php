<?php
// (A) ADD NEW SETTING
try {
  $_CORE->DB->insert("settings",
    ["setting_name", "setting_description", "setting_value", "setting_group"],
    ["SUGGEST_LIMIT", "Autocomplete suggestion limit", 5, 1]
  );
} catch (Exception $ex) {
  exit("Unable to create new setting.");
}

// (B) DELETE THIS SCRIPT
try {
  unlink(PATH_PAGES . "PAGE-install-autocomplete.php");
} catch (Exception $ex) {
  exit("Unable to delete PAGE-install-autocomplete.php, please do so manually.");
}

// (C) DONE
exit("Autocomplete module successfully installed.");