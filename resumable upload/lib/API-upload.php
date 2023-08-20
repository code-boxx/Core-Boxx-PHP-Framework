<?php
// (A) RECEIVE UPLOAD
if ($_CORE->Route->act == "recv") {
  $_CORE->load("Upload");
  $_CORE->Upload->recv();
}

// (B) ALL OTHER REQUESTS
else {
  // (B1) API ENDPOINTS
  $_CORE->autoAPI([
    "flush" => ["Upload", "flush", "A"]
  ]);

  // (B2) INVALID REQUEST
  $_CORE->respond(0, "Invalid request", null, null, 400);
}