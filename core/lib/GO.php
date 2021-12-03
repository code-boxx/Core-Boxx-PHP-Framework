<?php
// CORE BOXX FIRE STARTER
// TWEAK THIS STARTER SCRIPT TO YOUR OWN NEEDS

// (A) SETTINGS
// (A1) AUTOMATIC SYSTEM PATH
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);
define("PATH_BASE", dirname(PATH_LIB) . DIRECTORY_SEPARATOR);
define("PATH_API", PATH_BASE . "api" . DIRECTORY_SEPARATOR);

// (A2) HOST
define("HOST_BASE", "http://localhost/"); // CHANGE TO YOUR OWN!
define("HOST_NAME", parse_url(HOST_BASE, PHP_URL_HOST));
define("HOST_BASE_PATH", parse_url(HOST_BASE, PHP_URL_PATH));
define("HOST_API", HOST_BASE_PATH . "api/");
define("HOST_API_BASE", HOST_BASE . "api/");

// (A3) DATABASE - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (A4) API ENDPOINT
define("API_HTTPS", false); // enforce https for api endpoint
define("API_CORS", false);
// define("API_CORS", false); // no cors, accept host_name only
// define("API_CORS", true); // any domain + mobile apps
// define("API_CORS", "site-a.com"); // this domain only
// define("API_CORS", ["site-a.com", "site-b.com"]); // multiple domains

// (A5) PAGINATION
define("PAGE_PER", 20); // 20 entries per page by default

/* // (A6) JSON WEB TOKEN - CHANGE TO YOUR OWN!
// ENABLE THESE IF USING JWT IN USER MODULE LOGIN
define("JWT_SECRET", "YOUR-SECRET-KEY");
define("JWT_ISSUER", "YOUR-NAME");
define("JWT_ALGO", "HS256");
define("JWT_EXPIRE", 0); // IN SECONDS, 0 FOR NONE */

// (B) CORE START
// (B1) CORE LIBRARY
require PATH_LIB . "LIB-Core.php";
$_CORE = new CoreBoxx();

// (B2) PHP ERROR HANDLING
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 0);
// ini_set("log_errors", 1);
// ini_set("error_log", "PATH/error.log");

// (B3) GLOBAL ERROR HANDLING
define("ERR_SHOW", true); // show error details
// define("ERR_SHOW", false); // hide error details
function _CORERR ($ex) {
  global $_CORE;
  // add your own custom error handler with $_core->booboo->ouch()
  if ($_CORE->loaded("BooBoo")) { $_CORE->BooBoo->ouch($ex); }

  // or this will just output an error message
  else {
    $_CORE->respond(0,
    ERR_SHOW ? $ex->getMessage() : "OPPS! An error has occured.",
    ERR_SHOW ? [
    "code" => $ex->getCode(),
    "file" => $ex->getFile(),
    "line" => $ex->getLine()
    ] : null );
  }
}
set_exception_handler("_CORERR");

// (B4) START SESSION - IF YOU WANT
// session_start();

// (B5) LOAD DEFAULT MODULES
$_CORE->load("DB");
// add more if required, e.g. $_core->load("user");
