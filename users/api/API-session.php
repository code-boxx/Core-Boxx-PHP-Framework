<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) LOGIN - SESSION BASED
  // MAKE SURE SESSION_START() ENABLED IN LIB/CORE.PHP!
  case "inSess":
    $_CORE->autoAPI("Users", "inSess");
    break;

  // (C) LOGOFF - SESSION BASED
  // ALSO REMEMBER TO CLEAR WHAT YOU DON'T NEED FROM THE SESSION
  case "outSess":
    unset($_SESSION["user"]);
    $_CORE->respond(1, "OK");
    break;

  // (E) LOGIN - JWT COOKIE
  // ENABLE JWT SECTION IN LIB/CORE.PHP!
  case "inJWT":
    $_CORE->autoAPI("Users", "inJWT");
    break;

  // (F) LOGOUT - JWT COOKIE
  case "outJWT":
    setcookie("jwt", null, -1, "/", HOST_NAME, API_HTTPS);
    $_CORE->respond(1, "OK");
    break;
}
