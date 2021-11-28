<?php
switch ($_REQ) {
  // (A) INVALID REQUEST
  default:
    $_CORE->respond(0, "Invalid request");
    break;

  // (B) STEP 1 - GENERATE OTP & SEND VIA EMAIL
  case "generate":
    $_CORE->autoAPI("OTP", "generate");
    break;

  // (C) STEP 2 - VERIFY CHALLENGE
  case "challenge":
    $_CORE->autoAPI("OTP", "challenge");
    break;
}
