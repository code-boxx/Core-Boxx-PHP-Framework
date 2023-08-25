<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) CHECK - USER LEVEL
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (C) ADD "PASSWORLESS LOGIN" TO MENU
try {
  // (C1) BACKUP TEMPLATE TOP
  copy(PATH_PAGES . "TEMPLATE-top.php", PATH_PAGES . "TEMPLATE-top.old");

  // (C2) ADD "PASSWORLESS LOGIN"
  $data = file(PATH_PAGES . "TEMPLATE-top.php");
  foreach ($data as $j=>$line) {
    if (strpos($line, "myaccount") !== false) {
      array_splice($data, $j+3, 0, [
        "            ",
        "<!-- (LOGIN WITH WEBAUTHN) ADDED BY INSTALLER -->\r\n",
        "            ",
        '<li><a class="dropdown-item" href="<?=HOST_BASE?>passwordless">' . "\r\n",
        "              ",
        '<i class="ico-sm icon-key"></i> Passwordless Login' . "\r\n",
        "            ",
        "</a></li>\r\n"
      ]);
      break;
    }
  }

  // (C3) SAVE TEMPLATE TOP
  file_put_contents(PATH_PAGES . "TEMPLATE-top.php", implode("", $data));
  unset($data);
} catch (Exception $ex) {
  exit("Unable to update TEMPLATE-top.php - " . $ex->getMessage());
}

// (D) MODIFY LOGIN PAGE
try {
  // (D1) BACKUP LOGIN PAGE
  copy(PATH_PAGES . "PAGE-login.php", PATH_PAGES . "PAGE-login.old");

  // (D2) ADDITIONAL JS
  $data = file(PATH_PAGES . "PAGE-login.php");
  foreach ($data as $j=>$line) {
    if (strpos($line, "\$_PMETA") !== false) {
      array_splice($data, $j+1, 0, [
        "  // (LOGIN WITH WEBAUTHN) ADDED BY INSTALLER\r\n",
        '  ["s", HOST_ASSETS."PAGE-wa-helper.js", "defer"],' . "\r\n",
        '  ["s", HOST_ASSETS."PAGE-login-wa.js", "defer"],' . "\r\n"
      ]);
      break;
    }
  }

  // (D3) PASSWORDLESS LOGIN BUTTON
  foreach ($data as $j=>$line) {
    if (strpos($line, "(C2-2) MORE LOGIN") !== false) {
      array_splice($data, $j+1, 0, [
        "      <!-- (LOGIN WITH WEBAUTHN) ADDED BY INSTALLER -->\r\n",
        '      <button type="button" id="wa-in" onclick="wa.go()" disabled class="my-1 btn btn-primary d-flex-inline">' . "\r\n",
        '        <i class="ico-sm icon-key"></i> Passwordless' . "\r\n",
        "      </button>\r\n"
      ]);
      break;
    }
  }

  // (D4) SAVE LOGIN PAGE
  file_put_contents(PATH_PAGES . "PAGE-login.php", implode("", $data));
  unset($data);
} catch (Exception $ex) {
  exit("Unable to update PAGE-login.php - " . $ex->getMessage());
}

// (E) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-WAIN.php");
} catch (Exception $ex) {
  exit("Unable to delete install-WAIN.php, please do so manually.");
}

// (F) DONE
echo "WebAuthn Login module successfully installed.";