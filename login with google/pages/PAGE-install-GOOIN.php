<?php
// (A) CHECK - USER MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) CHECK - CREDENTIALS
if (!file_exists(PATH_LIB . "CRD-Google.json")) {
  exit(PATH_LIB . "CRD-Google.json not found.");
}

// (C) MODIFY LOGIN PAGE
$_CORE->load("MInstall");

// (C1) LOAD GOOGLE CLIENT LIBRARY
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php", "// (B) PAGE META",
  "\r\n" . <<<EOF
  // (LOGIN WITH GOOGLE) ADDED BY INSTALLER
  \$_CORE->load("GOOIN");
  if (isset(\$_GET["code"])) { \$_CORE->GOOIN->go(); }
  EOF . "\r\n", -2
);

// (C2) "OR SIGN IN WITH"
$_CORE->MInstall->cinsert(
  "or sign in", PATH_PAGES . "PAGE-login.php",
  "SOCIAL LOGIN",
  '    <div class="text-secondary my-3">- or sign in with -</div>' . "\r\n"
);

// (C3) LOGIN WITH GOOGLE BUTTON
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-login.php",
  "or sign in", <<<EOD
      <!-- (LOGIN WITH GOOGLE) ADDED BY INSTALLER -->
      <a class="my-1 btn btn-primary d-flex-inline" href="<?=\$_CORE->GOOIN->in()?>">
        <i class="ico-sm icon-google"></i> Google
      </a>
  EOD . "\r\n"
);

// (D) MODIFY REGISTRATION PAGE
// (D1) LOAD GOOGLE CLIENT LIBRARY
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-register.php", "// (B) PAGE META",
  "\r\n" . <<<EOF
  // (LOGIN WITH GOOGLE) ADDED BY INSTALLER
  \$_CORE->load("GOOIN");
  if (isset(\$_GET["code"])) { \$_CORE->GOOIN->go(); }
  EOF . "\r\n", -2
);

// (D2) "OR REGISTER WITH"
$_CORE->MInstall->cinsert(
  "or register with", PATH_PAGES . "PAGE-register.php",
  "(C3) SOCIAL REGISTER",
  '    <div class="text-secondary my-3">- or register with -</div>' . "\r\n"
);

// (D3) REGISTER WITH GOOGLE BUTTON
$_CORE->MInstall->insert(
  PATH_PAGES . "PAGE-register.php",
  "or register with", <<<EOD
      <!-- (REGISTER WITH GOOGLE) ADDED BY INSTALLER -->
      <a class="my-1 btn btn-primary d-flex-inline" href="<?=\$_CORE->GOOIN->in()?>">
        <i class="ico-sm icon-google"></i> Google
      </a>
  EOD . "\r\n"
);

// (E) CLEAN UP
$_CORE->MInstall->clean("GOOIN");