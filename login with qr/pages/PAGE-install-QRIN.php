<?php
// (A) CHECK - USER MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) CHECK - ADMIN MODULE
if (!defined("HOST_ADMIN")) {
  exit("Please install the admin module first.");
}

// (C) LOAD "QR LOGIN" SCRIPTS IN USER ADMIN PAGE
$_CORE->load("MInstall");
$_CORE->MInstall->insert(
  PATH_PAGES . "ADM-users.php",
  "\$_PMETA ", <<<EOD
    // (LOGIN WITH QR) ADDED BY INSTALLER
    ["s", HOST_ASSETS."ADM-users-qr.js", "defer"],
  EOD . "\r\n"
);

// (D) ADD "QR LOGIN" BUTTON TO USER ADMIN LIST
$_CORE->MInstall->insert(
  PATH_PAGES . "ADM-users-list.php",
  "</i> Edit", <<<EOD
        <!-- (LOGIN WITH QR) ADDED BY INSTALLER-->
        <li class="dropdown-item" onclick="uqr.show(<?=\$id?>)">
          <i class="text-secondary ico-sm icon-qrcode"></i> QR Login
        </li>
  EOD . "\r\n", 1
);

// (E) MODIFY LOGIN PAGE
// (E1) LOAD QR LOGIN JS
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
  "\$_PMETA", <<<EOD
    // (LOGIN WITH QR) ADDED BY INSTALLER
    ["s", HOST_ASSETS."html5-qrcode.min.js", "defer"],
    ["s", HOST_ASSETS."PAGE-login-qr.js", "defer"],
    ["c", HOST_ASSETS."PAGE-qrscan.css"],
  EOD . "\r\n"
);

// (E2) LOGIN WITH QR BUTTON
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
  "(C2-2) MORE LOGIN", <<<EOD
        <!-- (LOGIN WITH QR) ADDED BY INSTALLER -->
        <button type="button" id="qr-in" onclick="qrscan.go()" class="my-1 btn btn-primary d-flex-inline">
          <i class="ico-sm icon-qrcode"></i> QR
        </button>
  EOD . "\r\n"
);

// (F) CLEAN UP
$_CORE->MInstall->clean("QRIN");