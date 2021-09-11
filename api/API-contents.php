<?php
// @TODO - PROTECT THE FUNCTIONS
// E.G. CHECK IF USER IS AN ADMIN
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
    $_CORE->respond(1, null, $_CORE->autoCall("Contents", "get"));
    break;

  // (E) GET ALL OR SEARCH CONTENTS
  case "getAll":
    $contents = $_CORE->autoCall("Contents", "getAll");
    $_CORE->respond(1, null, $contents["data"], $contents["page"]);
    break;
}
