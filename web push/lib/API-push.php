<?php
switch ($_REQ) {
  // (B) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) SAVE SUBSCRIPTION
  case "save":
    $_CORE->autoAPI("Push", "save");
    break;

  // (C) DELETE SUBSCRIPTION
  case "del":
    $_CORE->autoAPI("Push", "del");
    break;

  // (D) SEND NOTIFICATIONS
    $_CORE->autoAPI("Push", "send");
    break;
}