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
    $_CORE->autoGETAPI("Contents", "get");
    break;

  // (E) GET ALL OR SEARCH CONTENTS
  case "getAll":
    $_CORE->autoGETAPI("Contents", "getAll");
    break;
}
