<?php
// (A) START CORE ENGINE & CHECKS
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) CHECK CREDENTIALS
if (!file_exists(PATH_LIB . "CRD-Google.json")) {
  exit(PATH_LIB . "CRD-Google.json not found.");
}

// (C) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-GOOIN.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (D) MODIFY LOGIN PAGE
try {
  // (D1) BACKUP LOGIN PAGE
  copy(PATH_PAGES . "PAGE-login.php", PATH_PAGES . "PAGE-login.old");

  // (D2) LOAD GOOGLE CLIENT LIBRARY
  $login = file(PATH_PAGES . "PAGE-login.php");
  foreach ($login as $j=>$line) {
    if (strpos($line, "ALREADY SIGNED IN") !== false) {
      array_splice($login, $j+2, 0, [
        "\r\n", "// LOGIN WITH GOOGLE - MODIFIED BY INSTALLER\r\n",
        '$_CORE->load("GOOIN");' . "\r\n",
        'if (isset($_GET["code"])) { $_CORE->GOOIN->go(); }' . "\r\n"
      ]);
      break;
    }
  }

  // (D3) ADD "LOGIN WITH GOOGLE" BUTTON
  foreach ($login as $j=>$line) {
    if (strpos($line, "Forgot Password") !== false) {
      array_splice($login, $j, 0, [
        "    <!-- LOGIN WITH GOOGLE - MODIFIED BY INSTALLER -->\r\n",
        '    <a class="btn btn-primary py-2 mb-4" href="<?=$_CORE->GOOIN->in()?>">Login With Google</a>' . "\r\n"
      ]);
      break;
    }
  }

  // (D4) UPDATE LOGIN PAGE
  file_put_contents(PATH_PAGES . "PAGE-login.php", implode("", $login));
} catch (Exception $ex) {
  exit("Unable to update PAGE-login.php - " . $ex->getMessage());
}

// (E) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-GOOIN.php");
} catch (Exception $ex) {
  exit("Unable to delete install-GOOIN.php, please do so manually.");
}

// (F) DONE
echo "Google Login module successfully installed.";
