<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) GET REACTS FOR SPECIFIED ID
  case "get":
    $_CORE->respond(1, null, $_CORE->autoCall("Reacts", "get"));
    break;

  // (C) SAVE REACTION
  case "save":
    $_CORE->autoapi("Reacts", "save");
    break;
}
