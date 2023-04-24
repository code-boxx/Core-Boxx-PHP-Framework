<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "get" => ["Calendar", "get"],
  "getPeriod" => ["Calendar", "getPeriod"],
  "save" => ["Calendar", "save"],
  "del" => ["Calendar", "del"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);