<?php
// (A) CHECK - USER MODULE
if (!defined("USR_LVL")) {
  exit("Please install the users module first.");
}

// (B) CHECK - ADMIN MODULE
if (!defined("HOST_ADMIN")) {
  exit("Please install the admin module first.");
}

// (C) ADD "NFC LOGIN" SCRIPTS TO USER ADMIN PAGE
try {
  // (C1) BACKUP USER ADMIN PAGE
  copy(PATH_PAGES . "ADM-users.php", PATH_PAGES . "ADM-users.old");

  // (C2) LOAD NFC LOGIN JS
  $data = file(PATH_PAGES . "ADM-users.php");
  foreach ($data as $j=>$line) {
    if (strpos($line, "\$_PMETA") !== false) {
      array_splice($data, $j+1, 0, [
        "  // (LOGIN WITH NFC) ADDED BY INSTALLER\r\n",
        '  ["s", HOST_ASSETS."PAGE-nfc.js", "defer"],' . "\r\n",
        '  ["s", HOST_ASSETS."ADM-users-nfc.js", "defer"],' . "\r\n"
      ]);
      break;
    }
  }

  // (C3) SAVE USER ADMIN PAGE
  file_put_contents(PATH_PAGES . "ADM-users.php", implode("", $data));
  unset($data);
} catch (Exception $ex) {
  exit("Unable to update ADM-users.php - " . $ex->getMessage());
}

// (D) MODIFY USER ADMIN LIST
try {
  // (D1) BACKUP USER ADMIN LIST
  copy(PATH_PAGES . "ADM-users-list.php", PATH_PAGES . "ADM-users-list.old");

  // (D2) ADD "NFC LOGIN" BUTTON
  $data = file(PATH_PAGES . "ADM-users-list.php");
  foreach ($data as $j=>$line) {
    if (strpos($line, "<ul class") !== false) {
      array_splice($data, $j+1, 0, [
        "      <!-- (LOGIN WITH NFC) ADDED BY INSTALLER-->\r\n",
        '      <li class="dropdown-item" onclick="unfc.show(<?=$id?>)">' . "\r\n",
        '        <i class="text-secondary ico-sm icon-feed"></i> NFC Login' . "\r\n",
        "      </li>\r\n"
      ]);
      break;
    }
  }

  // (D3) SAVE USER ADMIN LIST
  file_put_contents(PATH_PAGES . "ADM-users-list.php", implode("", $data));
  unset($data);
} catch (Exception $ex) {
  exit("Unable to update ADM-users-list.php - " . $ex->getMessage());
}

// (E) MODIFY LOGIN PAGE
try {
  // (E1) BACKUP LOGIN PAGE
  copy(PATH_PAGES . "PAGE-login.php", PATH_PAGES . "PAGE-login.old");

  // (E2) ADDITIONAL JS
  $data = file(PATH_PAGES . "PAGE-login.php");
  foreach ($data as $j=>$line) {
    if (strpos($line, "\$_PMETA") !== false) {
      array_splice($data, $j+1, 0, [
        "  // (LOGIN WITH NFC) ADDED BY INSTALLER\r\n",
        '  ["s", HOST_ASSETS."PAGE-nfc.js", "defer"],' . "\r\n",
        '  ["s", HOST_ASSETS."PAGE-login-nfc.js", "defer"],' . "\r\n"
      ]);
      break;
    }
  }

  // (E3) LOGIN WITH NFC BUTTON
  foreach ($data as $j=>$line) {
    if (strpos($line, "(C2-2) MORE LOGIN") !== false) {
      array_splice($data, $j+1, 0, [
        "      <!-- (LOGIN WITH NFC) ADDED BY INSTALLER -->\r\n",
        '      <button type="button" id="nfc-a" onclick="nin.go()" disabled class="my-1 btn btn-primary d-flex-inline">' . "\r\n",
        '        <i class="ico-sm icon-feed"></i> <span id="nfc-b">NFC</span>' . "\r\n",
        "      </button>\r\n"
      ]);
      break;
    }
  }

  // (E4) SAVE LOGIN PAGE
  file_put_contents(PATH_PAGES . "PAGE-login.php", implode("", $data));
  unset($data);
} catch (Exception $ex) {
  exit("Unable to update PAGE-login.php - " . $ex->getMessage());
}

// (F) DELETE THIS SCRIPT
try {
  unlink(PATH_PAGES . "PAGE-install-NFCIN.php");
} catch (Exception $ex) {
  exit("Unable to delete PAGE-install-NFCIN.php, please do so manually.");
}

// (G) DONE
exit("NFC Login module successfully installed.");