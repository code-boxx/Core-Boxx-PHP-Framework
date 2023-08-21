<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "get" => ["Reactions", "get"],
  "save" => ["Reactions", "save"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);