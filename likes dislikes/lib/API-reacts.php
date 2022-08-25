<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) GET REACTS FOR SPECIFIED ID
  case "get":
    $_CORE->autoGETAPI("Reacts", "get");
    break;

  // (C) SAVE REACTION
  case "save":
    if ($_CORE->autoCall("Reacts", "save")) {
      $_CORE->respond(1, "OK", $_CORE->autoCall("Reacts", "get"));
    } else { $_CORE->respond(0); }
    break;
}