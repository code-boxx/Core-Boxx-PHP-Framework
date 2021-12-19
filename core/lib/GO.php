<?php
// CORE BOXX FIRE STARTER
// DO A SEARCH FOR @CHANGE AND UPDATE THE SETTINGS TO YOUR OWN!

// (A) SETTINGS
// (A1) HOST
define("HOST_BASE", "http://localhost/"); // @CHANGE
define("HOST_NAME", parse_url(HOST_BASE, PHP_URL_HOST));
define("HOST_BASE_PATH", parse_url(HOST_BASE, PHP_URL_PATH));
define("HOST_API", HOST_BASE_PATH . "api/");
define("HOST_API_BASE", HOST_BASE . "api/");
define("HOST_ASSETS", HOST_BASE . "assets/");

// (A2) DATABASE - @CHANGE
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (A3) ERROR HANDLING
/* @CHANGE - DON'T DISPLAY ERRORS BUT KEEP IN ERROR LOG ON LIVE SYSTEMS
// (A3-1) RECOMMENDED FOR LIVE SERVER
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "PATH/error.log");
define("ERR_SHOW", false); */

// (A3-2) RECOMMENDED FOR DEVELOPMENT SERVER
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
ini_set("log_errors", 0);
define("ERR_SHOW", true);

/* @CHANGE - ENABLE THIS SECTION IF USING USER MODULE FOR LOGIN
// (A4) JSON WEB TOKEN
define("JWT_SECRET", "YOUR-SECRET-KEY");
define("JWT_ISSUER", "YOUR-NAME");
define("JWT_ALGO", "HS256");
define("JWT_EXPIRE", 0); // in seconds, 0 for none */

// (A5) API ENDPOINT
define("API_HTTPS", false); // enforce https for api endpoint
define("API_CORS", false);
// define("API_CORS", false); // no cors, accept host_name only
// define("API_CORS", true); // any domain + mobile apps
// define("API_CORS", "site-a.com"); // this domain only
// define("API_CORS", ["site-a.com", "site-b.com"]); // multiple domains

// (A6) AUTOMATIC SYSTEM PATH
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);
define("PATH_BASE", dirname(PATH_LIB) . DIRECTORY_SEPARATOR);
define("PATH_API", PATH_BASE . "api" . DIRECTORY_SEPARATOR);
define("PATH_ASSETS", PATH_BASE . "assets" . DIRECTORY_SEPARATOR);
define("PATH_PAGES", PATH_BASE . "pages" . DIRECTORY_SEPARATOR);

// (A7) PAGINATION
define("PAGE_PER", 20); // 20 entries per page by default

// (B) CORE START
// (B1) CORE LIBRARY + GLOBAL ERROR HANDLING
require PATH_LIB . "LIB-Core.php";
$_CORE = new CoreBoxx();
function _CORERR ($ex) { global $_CORE; $_CORE->ouch($ex); }
set_exception_handler("_CORERR");

// (B2) LOAD DEFAULT MODULES + STARTING SEQUENCE
// session_start(); // @CHANGE - START SESSION IF YOU WANT
$_CORE->load("DB");
// $_CORE->load("JWT"); // @CHANGE - ADD MORE MODULES AS REQUIRED
