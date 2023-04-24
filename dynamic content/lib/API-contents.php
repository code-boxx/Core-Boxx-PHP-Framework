<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "get" => ["Contents", "get"],
  "getAll" => ["Contents", "getAll"],
  "save" => ["Contents", "save"],
  "del" => ["Contents", "del"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);