<?php
// CORE BOXX FIRE STARTER
// BY DEFAULT - STARTS SESSION + LOAD DATABASE MODULE
// FEEL FREE TO TWEAK THIS STARTER SCRIPT TO YOUR OWN NEEDS

// (A) SETTINGS
// (A1) SYSTEM PATH
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);
define("PATH_BASE", dirname(PATH_LIB) . DIRECTORY_SEPARATOR);
define("PATH_API", PATH_BASE . "api" . DIRECTORY_SEPARATOR);

// (A2) HOST - CHANGE TO YOUR OWN!
define("HOST_BASE", "http://localhost/");
define("HOST_BASE_PATH", parse_url(HOST_BASE, PHP_URL_PATH));
define("HOST_API", "/api/");

// (A3) ENFORCE HTTPS FOR API ENDPOINT
define("API_HTTPS", false);

// (A4) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (A5) ERROR REPORTING - CHANGE TO YOUR OWN!
error_reporting(E_ALL & ~E_NOTICE);
define("ERR_SHOW", true);
ini_set("log_errors", 0);
function _CORERR ($ex) {
  $error = [
    "status" => 0,
    "message" => "OPPS! An error has occured."
  ];
  if (ERR_SHOW) {
    $error["message"] = $ex->getMessage();
    $error["code"] = $ex->getCode();
    $error["file"] = $ex->getFile();
    $error["line"] = $ex->getLine();
  }
  exit(json_encode($error));
}
set_exception_handler("_CORERR");

// (B) START SESSION
session_start();

// (C) CORE LIBRARIES
require PATH_LIB . "LIB-Core.php";
$_CORE = new CoreBoxx();
$_CORE->load("DB");
