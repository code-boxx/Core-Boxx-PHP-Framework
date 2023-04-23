<?php
// CALLED BY $_CORE->SESSION->__CONSTRUCT()
// USE THIS TO BUILD/OVERRIDE SESSION DATA WHEN UNPACKING THE JWT

/*
// (A) EXAMPLE - LOAD USER CUSTOM SETTINGS
if (isset($this->data["user"])) {
  $this->data["settings"] = $this->DB->fetchAll(
    "SELECT * FROM `user_settings` WHERE `user_id`=?",
    [$this->data["user"]["user_id"]]
  );
}

// (B) EXAMPLE - CHECK IF COUPON STILL VALID
if (isset($this->data["coupon"])) {
  $coupon = $this->DB->fetchAll(
    "SELECT * FROM `coupons` WHERE `coupon_id`=?",
    [$this->data["coupon"]]
  );
  if ($coupon["expire"] >= strtotime("now")) {
    unset($this->data["coupon"]);
  }
}
*/