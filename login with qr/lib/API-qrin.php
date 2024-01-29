<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "add" => ["QRIN", "add", "A"],
  "del" => ["QRIN", "del", "A"],
  "login" => ["QRIN", "login"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);