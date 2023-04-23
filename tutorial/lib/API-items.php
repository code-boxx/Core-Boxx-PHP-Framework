<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "getAll" => ["Items", "getAll"],
  "save" => ["Items", "save"],
  "del" => ["Items", "del"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);