<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "save" => ["Stars", "save", true]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);