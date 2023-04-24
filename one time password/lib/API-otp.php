<?php
// (A) API ENDPOINTS
$_CORE->autoAPI([
  "generate" => ["OTP", "generate"],
  "challenge" => ["OTP", "challenge"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);