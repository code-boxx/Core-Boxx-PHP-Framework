<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "getAll" => ["Comments", "getAll"],
  "save" => ["Comments", "savewc"],
  "del" => ["Comments", "delwc"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);