<?php
/* (A) ADMIN ONLY
if (!isset($_SESS["user"])) {
  $_CORE->respond(0, "Please sign in first", null, null, 403);
} */

switch ($_REQ) {
  // (B) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (C) GET EVENT
  case "get":
    $_CORE->autoGETAPI("Calendar", "get");
    break;

  // (D) GET DATES & EVENTS FOR SELECTED PERIOD
  case "getPeriod":
    $_CORE->autoGETAPI("Calendar", "getPeriod");
    break;

  // (E) SAVE EVENT
  case "save":
    $_CORE->autoAPI("Calendar", "save");
    break;

  // (F) DELETE EVENT
  case "del":
    $_CORE->autoAPI("Calendar", "del");
    break;
}