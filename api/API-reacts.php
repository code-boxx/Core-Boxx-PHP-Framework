<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) GET REACTS FOR SPECIFIED ID
  case "get":
    $_CORE->load("Reacts");
    $reacts = $_CORE->Reacts->get($_POST['id'], $_POST['uid']);
    $_CORE->respond(1, null, $reacts);
    break;

  // (C) SAVE REACTION
  case "save":
    $_CORE->autoapi("Reacts", "save");
    break;
}
