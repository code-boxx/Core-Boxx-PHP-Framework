<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "getAll" => ["Comments", "getAll"],
  "save" => ["Comments", "save"],
  "del" => ["Comments", "del"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);