<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) SAVE A COMMENT
  case "save":
    $_CORE->autoAPI("Comments", "save");
    break;

  // (C) DELETE A COMMENT
  case "del":
    $_CORE->autoAPI("Comments", "del");
    break;

  // (D) GET COMMENTS
  case "getAll":
    $_CORE->autoGETAPI("Comments", "getAll");
    break;
}
