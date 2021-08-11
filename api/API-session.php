<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) LOGIN
  case "login":
    // (B1) ALREADY SIGNED IN
    if (isset($_SESSION['user'])) {
      $_CORE->respond(1, "Already signed in");
      exit();
    }

    // (B2) VERIFY
    $_CORE->load("Users");
    if ($_CORE->Users->verify($_POST['email'], $_POST['password'])) { $_CORE->respond(1, "OK"); }
    else { $_CORE->respond(0); }
    break;

  // (C) LOGOFF
  case "logoff":
    // @ALSO REMEMBER TO CLEAR WHAT YOU DON'T NEED FROM THE SESSION
    unset($_SESSION['user']);
    $_CORE->respond(1, "OK");
    break;
}
