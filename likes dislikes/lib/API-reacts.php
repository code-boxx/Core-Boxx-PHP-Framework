<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "get" => ["Reacts", "get"],
  "save" => ["Reacts", "save"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);