<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) CHECK - USER LEVEL
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (C) CHECK - CREDENTIALS
if (!file_exists(PATH_LIB . "CRD-Google.json")) {
  exit(PATH_LIB . "CRD-Google.json not found.");
}

// (D) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-GOOIN.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (E) MODIFY LOGIN PAGE
try {
  // (E1) BACKUP LOGIN PAGE
  copy(PATH_PAGES . "PAGE-login.php", PATH_PAGES . "PAGE-login.old");

  // (E2) LOAD GOOGLE CLIENT LIBRARY
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

  // (E3) ADD "LOGIN WITH GOOGLE" BUTTON
  foreach ($login as $j=>$line) {
    if (strpos($line, "(C2-3) SOCIAL LOGIN") !== false) {
      // (E3-1) "OR SIGN IN WITH"
      $pointer = $j+1;
      if (strpos($login[$pointer], "or sign in with") == false) {
        array_splice($login, $pointer, 0, [
          '    <div class="text-secondary my-3">- or sign in with -</div>' . "\r\n"
        ]);
      }
      $pointer++;

      // (E3-2) "LOGIN WITH GOOGLE"
      array_splice($login, $pointer, 0, [
        "    <!-- (LOGIN WITH GOOGLE) ADDED BY INSTALLER -->\r\n",
        '    <a class="my-1 btn btn-primary d-flex-inline align-items-center justify-content-center" href="<?=$_CORE->GOOIN->in()?>">' . "\r\n",
        '      <i class="ico-sm icon-google me-1"></i> Google' . "\r\n",
        '    </a>' . "\r\n"
      ]);
      break;
    }
  }

  // (E4) UPDATE LOGIN PAGE
  file_put_contents(PATH_PAGES . "PAGE-login.php", implode("", $login));
  unset($login);
} catch (Exception $ex) {
  exit("Unable to update PAGE-login.php - " . $ex->getMessage());
}

// (F) MODIFY REGISTRATION PAGE
try {
  // (F1) BACKUP REGISTRATION PAGE
  copy(PATH_PAGES . "PAGE-register.php", PATH_PAGES . "PAGE-register.old");

  // (F2) LOAD GOOGLE CLIENT LIBRARY
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

  // (F3) ADD "SIGN UP WITH GOOGLE" BUTTON
  foreach ($reg as $j=>$line) {
    if (strpos($line, "(C3) SOCIAL REGISTER") !== false) {
      // (F3-1) "OR REGISTER WITH"
      $pointer = $j+1;
      if (strpos($reg[$pointer], "or register with") == false) {
        array_splice($reg, $pointer, 0, [
          '    <div class="text-secondary my-3">- or register with -</div>' . "\r\n"
        ]);
      }
      $pointer++;

      // (F3-2) "SIGN UP WITH GOOGLE"
      array_splice($reg, $pointer, 0, [
        "    <!-- (REGISTER WITH GOOGLE) ADDED BY INSTALLER -->\r\n",
        '    <a class="my-1 btn btn-primary d-flex-inline align-items-center justify-content-center" href="<?=$_CORE->GOOIN->in()?>">' . "\r\n",
        '      <i class="ico-sm icon-google me-1"></i> Google' . "\r\n",
        '    </a>' . "\r\n"
      ]);
      break;
    }
  }
  
  // (F4) UPDATE REGISTRATION PAGE
  file_put_contents(PATH_PAGES . "PAGE-register.php", implode("", $reg));
} catch (Exception $ex) {
  exit("Unable to update PAGE-register.php - " . $ex->getMessage());
}

// (G) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-GOOIN.php");
} catch (Exception $ex) {
  exit("Unable to delete install-GOOIN.php, please do so manually.");
}

// (H) DONE
echo "Google Login module successfully installed.";