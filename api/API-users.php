<?php
// @TODO - PROTECT USER ADMIN FUNCTIONS!
if (!isset($_SESSION['user'])) {
  $_CORE->respond(0, "Please sign in first");
}
$_CORE->load("Users");
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) GET USER
  case "get":
    $_CORE->respond(1, null, $_CORE->Users->get($_POST['id']));
    break;

  // (C) GET USERS
  case "getAll":
    // @TODO - YOU MIGHT WANT TO ADD YOUR OWN PAGINATION
    $_CORE->respond(1, null, $_CORE->Users->getAll());
    break;

  // (D) SEARCH USERS
  case "search":
    // @TODO - YOU MIGHT WANT TO ADD YOUR OWN PAGINATION
    $_CORE->respond(1, null, $_CORE->Users->search($_POST['search']));
    break;

  // (E) SAVE USER
  case "save":
    $_CORE->autoAPI("Users", "save");
    break;

  // (F) DELETE USER
  case "del":
    $_CORE->autoAPI("Users", "del");
    break;
}
