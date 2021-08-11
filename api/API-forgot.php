<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) RESET REQUEST
  case "request":
    $_CORE->autoAPI("Forgot", "request");
    break;

  // (C) PROCESS RESET
  case "reset":
    $_CORE->autoAPI("Forgot", "reset");
    break;
}
