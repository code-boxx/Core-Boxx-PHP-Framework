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
  $add = <<<EOD
  // ADDED BY INSTALLER - PUSH NOTIFICATION
  define("PUSH_PUBLIC", "{$keys["publicKey"]}");
  define("PUSH_PRIVATE", "{$keys["privateKey"]}");
  EOD;
  $fh = fopen(PATH_LIB . "CORE-Config.php", "a");
  fwrite($fh, "\r\n\r\n$add");
  fclose($fh);
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