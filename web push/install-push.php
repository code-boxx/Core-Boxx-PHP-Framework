<?php
// (A) START CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) IMPORT SQL
try {
  $_CORE->DB->query(file_get_contents(PATH_LIB . "SQL-WebPush.sql"));
} catch (Exception $ex) {
  exit("Unable to import SQL - " . $ex->getMessage());
}

// (C) UPDATE CORE-CONFIG.PHP
try {
  // (C1) GENERATE VAPID KEYS
  require PATH_LIB . "webpush/autoload.php";
  $keys = Minishlink\WebPush\VAPID::createVapidKeys();
  if ($keys == null) {
    exit("Unabled to create keys, please make sure OpenSSL is properly installed.");
  }

  // (C2) BACKUP CORE-CONFIG.PHP
  copy(PATH_LIB . "CORE-Config.php", PATH_LIB . "CORE-Config.old");

  // (C3) INSERT KEYS INTO CORE-CONFIG.PHP
  $cfg = file(PATH_LIB . "CORE-Config.php");
  foreach ($cfg as $l=>$line) {
    if (strpos($line, "PUSH_PUBLIC") !== false) {
      $cfg[$l] = "define(\"PUSH_PUBLIC\", \"" . $keys["publicKey"] . "\"); // CHANGED BY INSTALLER\r\n";
    }
    if (strpos($line, "PUSH_PRIVATE") !== false) {
      $cfg[$l] = "define(\"PUSH_PRIVATE\", \"" . $keys["privateKey"] . "\"); // CHANGED BY INSTALLER\r\n";
    }
  }
  file_put_contents(PATH_LIB . "CORE-Config.php", implode("", $cfg));
} catch (Exception $ex) {
  exit("Unable to update CORE-Config.php - " . $ex->getMessage());
}

// (D) DELETE THIS SCRIPT
try {
  unlink(PATH_BASE . "install-push.php");
} catch (Exception $ex) {
  exit("Unable to delete install-push.php, please do so manually.");
}

// (E) DONE
echo "Web Push module successfully installed.";