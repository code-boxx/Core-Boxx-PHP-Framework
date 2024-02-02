<?php
// (A) CHECK - USER MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) CHECK - ADMIN MODULE
if (!defined("HOST_ADMIN")) {
  exit("Please install the admin module first.");
}

// (C) LOAD "NFC LOGIN" SCRIPTS IN USER ADMIN PAGE
$_CORE->load("MInstall");
$_CORE->MInstall->insert(
  PATH_PAGES . "ADM-users.php",
  "\$_PMETA ", <<<EOD
    // (LOGIN WITH NFC) ADDED BY INSTALLER
    ["l", HOST_ASSETS."PAGE-nfc.css"],
    ["s", HOST_ASSETS."PAGE-nfc.js", "defer"],
    ["s", HOST_ASSETS."ADM-users-nfc.js", "defer"],
  EOD . "\r\n"
);

// (D) ADD "NFC LOGIN" BUTTON TO USER ADMIN LIST
$_CORE->MInstall->insert(
  PATH_PAGES . "ADM-users-list.php",
  "</i> Edit", <<<EOD
        <!-- (LOGIN WITH NFC) ADDED BY INSTALLER-->
        <li class="dropdown-item" onclick="unfc.show(<?=\$id?>)">
          <i class="text-secondary ico-sm icon-feed"></i> NFC Login
        </li>
  EOD . "\r\n", 1
);

// (E) MODIFY LOGIN PAGE
// (E1) LOAD NFC LOGIN JS
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
  "\$_PMETA", <<<EOD
    // (LOGIN WITH NFC) ADDED BY INSTALLER
    ["l", HOST_ASSETS."PAGE-nfc.css"],
    ["s", HOST_ASSETS."PAGE-nfc.js", "defer"],
    ["s", HOST_ASSETS."PAGE-login-nfc.js", "defer"],
  EOD . "\r\n"
);

// (E2) LOGIN WITH NFC BUTTON
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
  "(C2-2) MORE LOGIN", <<<EOD
        <!-- (LOGIN WITH NFC) ADDED BY INSTALLER -->
        <button type="button" id="nfc-in" onclick="nfc.scan()" disabled class="my-1 btn btn-primary d-flex-inline">
          <i class="ico-sm icon-feed"></i> NFC
        </button>
  EOD . "\r\n"
);

// (F) CLEAN UP
$_CORE->MInstall->clean("NFCIN");