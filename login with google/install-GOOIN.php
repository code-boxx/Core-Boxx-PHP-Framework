<?php
// (A) PASTE YOUR CLIENT ID & SECRET HERE
$clientID = "";
$clientSecret = "";

// (B) START CORE ENGINE & CHECKS
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}
if ($clientID=="" || $clientSecret=="") {
  exit("Please enter your client ID and secret.");
}

// (C) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-GOOIN.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (D) ADD CLIENT ID & SECRET TO CORE-CONFIG.PHP
try {
  copy(PATH_LIB . "CORE-Config.php", PATH_LIB . "CORE-Config.old");
  $add = <<<EOD
  // ADDED BY INSTALLER - LOGIN WITH GOOGLE
  define("GOOGLE_CLIENT_ID", "$clientID");
  define("GOOGLE_CLIENT_SECRET", "$clientSecret");
  EOD;
  $fh = fopen(PATH_LIB . "CORE-Config.php", "a");
  fwrite($fh, "\r\n\r\n$add");
  fclose($fh);
} catch (Exception $ex) {
  exit("Unable to update CORE-Config.php - " . $ex->getMessage());
}

// (E) MODIFY LOGIN PAGE
try {
  // (E1) BACKUP LOGIN PAGE
  copy(PATH_PAGES . "PAGE-login.php", PATH_PAGES . "PAGE-login.old");

  // (E2) LOAD GOOGLE CLIENT LIBRARY
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

  // (E3) ADD "LOGIN WITH GOOGLE" BUTTON
  foreach ($login as $j=>$line) {
    if (strpos($line, "Forgot Password") !== false) {
      array_splice($login, $j, 0, [
        "    <!-- LOGIN WITH GOOGLE - MODIFIED BY INSTALLER -->\r\n",
        '    <a class="btn btn-primary py-2 mb-4" href="<?=$_CORE->GOOIN->in()?>">Login With Google</a>' . "\r\n"
      ]);
      break;
    }
  }

  // (E4) UPDATE LOGIN PAGE
  file_put_contents(PATH_PAGES . "PAGE-login.php", implode("", $login));
} catch (Exception $ex) {
  exit("Unable to update PAGE-login.php - " . $ex->getMessage());
}

// (F) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-GOOIN.php");
} catch (Exception $ex) {
  exit("Unable to delete install-GOOIN.php, please do so manually.");
}

// (G) DONE
echo "Google Login module successfully installed.";