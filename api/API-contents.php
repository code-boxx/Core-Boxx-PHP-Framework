<?php
// @TODO - PROTECT THE FUNCTIONS
// E.G. CHECK IF USER IS AN ADMIN
$_CORE->load("Contents");
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) SAVE CONTENT
  case "save":
    $_CORE->autoAPI("Contents", "save");
    break;

  // (C) DELETE CONTENT
  case "del":
    $_CORE->autoAPI("Contents", "del");
    break;

  // (D) GET CONTENT
  case "get":
    $_CORE->respond(1, null, $_CORE->Contents->get($_POST['id']));
    break;

  // (E) GET ALL CONTENTS
  case "getAll":
    $_CORE->respond(1, null, $_CORE->Contents->getAll());
    break;

  // (F) SEARCH CONTENTS
  case "search":
    $_CORE->respond(1, null, $_CORE->Contents->search($_POST['search']));
    break;
}
