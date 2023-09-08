<?php
// (A) KOA SUTATO
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-Go.php";

// (B) NEW CHATBOT PATH
define("PATH_CHATBOT", PATH_BASE . "chatbot" . DIRECTORY_SEPARATOR);

// (C) BACKUP CHATBOT/SETTINGS.PY
if (!copy(PATH_CHATBOT . "settings.py", PATH_CHATBOT . "settings.old")) {
  exit("Failed to backup settings file - " . PATH_CHATBOT . "settings.old");
}

// (D) COPY HOST SETTINGS FROM CORE-CONFIG.PHP TO SETTINGS.PY
$replace = [
  "http_allow" => "[\"http://".HOST_NAME."\", \"https://".HOST_NAME."\"]",
  "http_host" => "\"".HOST_NAME."\"",
  "jwt_algo" => "\"".JWT_ALGO."\"",
  "jwt_secret" => "\"".JWT_SECRET."\""
];
$cfg = file(PATH_CHATBOT . "settings.py") or exit("Cannot read". PATH_CHATBOT ."settings.py");
foreach ($cfg as $j=>$line) { foreach ($replace as $k=>$v) { if (strpos($line, $k) !== false) {
  $cfg[$j] = "$k = $v # CHANGED BY INSTALLER\r\n";
  unset($replace[$k]);
  if (count($replace)==0) { break; }
}}}
try { file_put_contents(PATH_CHATBOT . "settings.py", implode("", $cfg)); }
catch (Exception $ex) { exit("Error writing to ". PATH_CHATBOT . "settings.py"); }

// (E) ADD AI TO CORE-CONFIG.PHP
try {
  // (E1) BACKUP CONFIG FILE
  copy(PATH_LIB . "CORE-Config.php", PATH_LIB . "CORE-Config.old");

  // (E2) ADD URL & PATH
  $url = parse_url(HOST_BASE, PHP_URL_SCHEME) . "://" . HOST_NAME . ":8008";
  $add = <<<EOD
  // ADDED BY INSTALLER - AI CHATBOT
  define("PATH_CHATBOT", PATH_BASE . "chatbot" . DIRECTORY_SEPARATOR);
  define("HOST_CHATBOT", "$url");
  EOD;
  $fh = fopen(PATH_LIB . "CORE-Config.php", "a");
  fwrite($fh, "\r\n\r\n$add");
  fclose($fh);
} catch (Exception $ex) {
  exit("Unable to update CORE-Config.php - " . $ex->getMessage());
}