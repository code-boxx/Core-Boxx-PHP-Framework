<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "save" => ["Push", "save"],
  "del" => ["Push", "del"],
  "send" => ["Push", "send"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);