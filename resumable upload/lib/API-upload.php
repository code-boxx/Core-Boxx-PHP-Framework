<?php
switch ($_REQ) {
  // (A) BAD REQUEST
  default:
    $_CORE->respond(0, "Invalid request", null, null, 400);
    break;

  // (B) RECIEVE UPLOAD
  case "recv":
    $_CORE->load("Upload");
    $_CORE->Upload->recv();
    break;

  // (C) FLUSH TEMP FOLDER
  case "flush":
    $_CORE->autoAPI("Upload", "flush");
    break;
}