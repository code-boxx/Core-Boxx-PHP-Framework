<?php
// CALLED BY $_CORE->SESSION->__CONSTRUCT()
// USE THIS TO BUILD/OVERRIDE SESSION DATA WHEN UNPACKING THE JWT

/*
// EXAMPLE - LOAD USER CUSTOM SETTINGS
if (isset($_SESSION["user"])) {
  $_SESSION["settings"] = $this->DB->fetchAll(
    "SELECT * FROM `user_settings` WHERE `user_id`=?",
    [$_SESSION["user"]["user_id"]]
  );
}

// EXAMPLE - CHECK IF COUPON STILL VALID
if (isset($_SESSION["coupon"])) {
  $coupon = $this->DB->fetchAll(
    "SELECT * FROM `coupons` WHERE `coupon_id`=?",
    [$_SESSION["coupon"]]
  );
  if ($coupon["expire"] >= strtotime("now")) {
    unset($_SESSION["coupon"]);
  }
}
*/