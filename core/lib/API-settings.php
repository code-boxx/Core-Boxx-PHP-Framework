<?php
// (A) ADMIN ONLY
if (!isset($_CORE->Session->data["user"])) {
  $_CORE->respond(0, "Please sign in first", null, null, 403);
}

// (B) API ENDPOINTS
$_CORE->autoAPI([
  "save" => ["Settings", "save"]
]);

// (C) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);