<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) GET ALL
  case "getAll":
    $_CORE->autoGETAPI("Content", "getAll");
    break;

  // (C) SAVE CONTENT
  case "save":
    $_CORE->autoAPI("Content", "save");
    break;
}