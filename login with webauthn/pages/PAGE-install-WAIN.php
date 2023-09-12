<?php
// (A) CHECK - USER MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) ADD "PASSWORDLESS LOGIN" TO USER MENU
$_CORE->load("MInstall");
$_CORE->MInstall->insert(
  PATH_PAGES . "TEMPLATE-top.php",
  "cb.bye()", <<<EOD
              <!-- (LOGIN WITH WEBAUTHN) ADDED BY INSTALLER -->
              <li><a class="dropdown-item" href="<?=HOST_BASE?>passwordless">
                <i class="text-secondary ico-sm icon-key"></i> Passwordless Login
              </a></li>
  EOD . "\r\n", -1
);

// (C) LOGIN PAGE - LOAD WEBAUTH JS
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
  "\$_PMETA", <<<EOD
    // (LOGIN WITH WEBAUTHN) ADDED BY INSTALLER
    ["s", HOST_ASSETS."PAGE-wa-helper.js", "defer"],
    ["s", HOST_ASSETS."PAGE-login-wa.js", "defer"],
  EOD . "\r\n",
);

// (D) LOGIN PAGE - PASSWORDLESS LOGIN BUTTON
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
    "(C2-2) MORE LOGIN", <<<EOD
        <!-- (LOGIN WITH WEBAUTHN) ADDED BY INSTALLER -->
        <button type="button" id="wa-in" onclick="wa.go()" disabled class="my-1 btn btn-primary d-flex-inline">
          <i class="ico-sm icon-key"></i> Passwordless
        </button>
  EOD . "\r\n",
);

// (E) CLEAN UP
$_CORE->MInstall->clean("WAIN");