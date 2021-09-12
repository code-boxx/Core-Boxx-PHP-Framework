<?php
// @TODO - PROTECT USER ADMIN FUNCTIONS!
if (!isset($_SESSION["user"])) {
  $_CORE->respond(0, "Please sign in first");
}
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) GET USER
  case "get":
    $_CORE->autoGETAPI("Users", "get");
    break;

  // (C) GET OR SEARCH USERS
  case "getAll":
    $_CORE->autoGETAPI("Users", "getAll");
    break;

  // (D) SAVE USER
  case "save":
    $_CORE->autoAPI("Users", "save");
    break;

  // (E) DELETE USER
  case "del":
    $_CORE->autoAPI("Users", "del");
    break;
}
