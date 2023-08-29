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
try {
  // (C1) BACKUP LOGIN PAGE
  copy(PATH_PAGES . "PAGE-login.php", PATH_PAGES . "PAGE-login.old");

  // (C2) LOAD GOOGLE CLIENT LIBRARY
  $login = file(PATH_PAGES . "PAGE-login.php");
  foreach ($login as $j=>$line) {
    if (strpos($line, "// (B) PAGE META") !== false) {
      array_splice($login, $j-1, 0, [
        "\r\n", "// (LOGIN WITH GOOGLE) ADDED BY INSTALLER\r\n",
        '$_CORE->load("GOOIN");' . "\r\n",
        'if (isset($_GET["code"])) { $_CORE->GOOIN->go(); }' . "\r\n"
      ]);
      break;
    }
  }

  // (C3) ADD "LOGIN WITH GOOGLE" BUTTON
  foreach ($login as $j=>$line) {
    if (strpos($line, "(C2-3) SOCIAL LOGIN") !== false) {
      // (D3-1) "OR SIGN IN WITH"
      $pointer = $j+1;
      if (strpos($login[$pointer], "or sign in with") == false) {
        array_splice($login, $pointer, 0, [
          '    <div class="text-secondary my-3">- or sign in with -</div>' . "\r\n"
        ]);
      }
      $pointer++;

      // (D3-2) "LOGIN WITH GOOGLE"
      array_splice($login, $pointer, 0, [
        "    <!-- (LOGIN WITH GOOGLE) ADDED BY INSTALLER -->\r\n",
        '    <a class="my-1 btn btn-primary d-flex-inline" href="<?=$_CORE->GOOIN->in()?>">' . "\r\n",
        '      <i class="ico-sm icon-google"></i> Google' . "\r\n",
        '    </a>' . "\r\n"
      ]);
      break;
    }
  }

  // (C4) UPDATE LOGIN PAGE
  file_put_contents(PATH_PAGES . "PAGE-login.php", implode("", $login));
  unset($login);
} catch (Exception $ex) {
  exit("Unable to update PAGE-login.php - " . $ex->getMessage());
}

// (D) MODIFY REGISTRATION PAGE
try {
  // (D1) BACKUP REGISTRATION PAGE
  copy(PATH_PAGES . "PAGE-register.php", PATH_PAGES . "PAGE-register.old");

  // (D2) LOAD GOOGLE CLIENT LIBRARY
  $reg = file(PATH_PAGES . "PAGE-register.php");
  foreach ($reg as $j=>$line) {
    if (strpos($line, "// (B) PAGE META") !== false) {
      array_splice($reg, $j-1, 0, [
        "\r\n", "// (REGISTER WITH GOOGLE) ADDED BY INSTALLER\r\n",
        '$_CORE->load("GOOIN");' . "\r\n",
        'if (isset($_GET["code"])) { $_CORE->GOOIN->go(); }' . "\r\n"
      ]);
      break;
    }
  }

  // (D3) ADD "SIGN UP WITH GOOGLE" BUTTON
  foreach ($reg as $j=>$line) {
    if (strpos($line, "(C3) SOCIAL REGISTER") !== false) {
      // (D3-1) "OR REGISTER WITH"
      $pointer = $j+1;
      if (strpos($reg[$pointer], "or register with") == false) {
        array_splice($reg, $pointer, 0, [
          '    <div class="text-secondary my-3">- or register with -</div>' . "\r\n"
        ]);
      }
      $pointer++;

      // (D3-2) "SIGN UP WITH GOOGLE"
      array_splice($reg, $pointer, 0, [
        "    <!-- (REGISTER WITH GOOGLE) ADDED BY INSTALLER -->\r\n",
        '    <a class="my-1 btn btn-primary d-flex-inline" href="<?=$_CORE->GOOIN->in()?>">' . "\r\n",
        '      <i class="ico-sm icon-google me-1"></i> Google' . "\r\n",
        '    </a>' . "\r\n"
      ]);
      break;
    }
  }
  
  // (D4) UPDATE REGISTRATION PAGE
  file_put_contents(PATH_PAGES . "PAGE-register.php", implode("", $reg));
} catch (Exception $ex) {
  exit("Unable to update PAGE-register.php - " . $ex->getMessage());
}

// (E) DELETE THIS SCRIPT
try {
  unlink(PATH_PAGES . "PAGE-install-GOOIN.php");
} catch (Exception $ex) {
  exit("Unable to delete PAGE-install-GOOIN.php, please do so manually.");
}

// (F) DONE
exit("Google Login module successfully installed.");