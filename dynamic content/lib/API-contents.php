<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "get" => ["Contents", "get"],
  "getAll" => ["Contents", "getAll", "A"],
  "save" => ["Contents", "save", "A"],
  "del" => ["Contents", "del", "A"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);