<?php
// (A) CHECK OPENSSL
if (!extension_loaded("openssl")) {
  exit("OPENSSL extension not enabled.");
}

// (B) IMPORT SQL
$_CORE->load("MInstall");
$_CORE->MInstall->sql("WebPush");

// (C) GENERATE VAPID KEYS
require PATH_LIB . "webpush/autoload.php";
$keys = Minishlink\WebPush\VAPID::createVapidKeys();
if ($keys==null || $keys==false || $keys=="") {
  exit("Unable to create keys, please make sure OpenSSL is properly installed and configured.");
}

// (D) INSERT KEYS INTO CORE-CONFIG.PHP
$_CORE->MInstall->append(
  PATH_LIB . "CORE-Config.php",
  "\r\n\r\n" . <<<EOD
  // ADDED BY INSTALLER - PUSH NOTIFICATION
  define("PUSH_PUBLIC", "{$keys["publicKey"]}");
  define("PUSH_PRIVATE", "{$keys["privateKey"]}");
  EOD
);

// (E) CLEAN UP
$_CORE->MInstall->clean("push");