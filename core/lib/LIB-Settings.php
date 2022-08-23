<?php
class Settings extends Core {
  // (A) CONSTRUCTOR - LOAD SYSTEM SETTINGS
  function __construct ($core) {
    parent::__construct($core);
    foreach ($this->DB->fetchKV(
      "SELECT * FROM `settings` WHERE `setting_group`=?",
      [1], "setting_name", "setting_value"
    ) as $k=>$v) { define($k, $v); }
  }

  // (B) GET SETTINGS
  //  $group : setting group
  function getAll ($group=1) {
    return $this->DB->fetchAll("SELECT * FROM `settings` WHERE `setting_group`=?", [$group]);
  }

  // (C) SAVE SETTINGS
  //  $settings : array, key => value
  function save ($settings) {
    foreach ($settings as $k=>$v) {
      $this->DB->update("settings", ["setting_value"], "`setting_name`=?", [$v, $k]);
    }
    return true;
  }
}