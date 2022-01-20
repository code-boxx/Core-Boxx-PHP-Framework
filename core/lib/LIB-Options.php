<?php
class Options extends Core {
  // (A) CONSTRUCTOR - LOAD SYSTEM OPTIONS
  function __construct ($core) {
    parent::__construct($core);
    foreach ($this->get(1) as $k=>$v) { define($k, $v); }
  }

  // (B) GET OPTIONS
  //  $group : option group
  function get ($group=1) {
    return $this->DB->fetchKV(
      "SELECT * FROM `options` WHERE `option_group`=?",
      [$group], "option_name", "option_value"
    );
  }

  // (C) SAVE OPTIONS
  //  $options : array, key => value
  function save ($options) {
    foreach ($options as $k=>$v) {
      $this->DB->update("options",
        ["option_value"], "`option_name`=?", [$v, $k]
      );
    }
    return true;
  }
}
