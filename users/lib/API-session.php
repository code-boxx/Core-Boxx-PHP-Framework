<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) LOGIN
  case "login":
    $_CORE->autoAPI("Users", "login");
    break;

  // (C) LOGOUT
  case "logout":
    $_CORE->autoAPI("Users", "logout");
    break;

  // (D) REGISTER
  case "register":
    $_CORE->autoAPI("Users", "register");
    break;

  // (E) REQUEST PASSWORD RESET
  case "forgotA":
    $_CORE->autoAPI("Forgot", "request");
    break;

  // (F) PROCESS PASSWORD RESET
  case "forgotB":
    $_CORE->autoAPI("Forgot", "reset");
    break;
}