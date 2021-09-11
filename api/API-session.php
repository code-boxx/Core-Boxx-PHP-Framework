<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) LOGIN
  case "login":
    // (B1) ALREADY SIGNED IN
    if (isset($_SESSION["user"])) {
      $_CORE->respond(1, "Already signed in");
    }

    // (B2) VERIFY
    $_CORE->autoAPI("Users", "verify");
    break;

  // (C) LOGOFF
  case "logoff":
    // @TODO - ALSO REMEMBER TO CLEAR WHAT YOU DON'T NEED FROM THE SESSION
    unset($_SESSION["user"]);
    $_CORE->respond(1, "OK");
    break;
}
