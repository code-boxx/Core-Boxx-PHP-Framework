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

// (B) CLEAN UP
$_CORE->load("MInstall");
$_CORE->MInstall->clean("autocomplete");