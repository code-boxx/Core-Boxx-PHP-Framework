<?php
// (A) LOAD CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "GO.php";

// (B) GENERATE HTACCESS FILE
$htaccess = PATH_BASE . ".htaccess";
if (!file_exists($htaccess)) {
  if (file_put_contents($htaccess, implode("\r\n", [
    "RewriteEngine On",
    "RewriteBase " . HOST_BASE_PATH,
    "RewriteRule ^index\.php$ - [L]",
    "RewriteCond %{REQUEST_FILENAME} !-f",
    "RewriteCond %{REQUEST_FILENAME} !-d",
    "RewriteRule . " . HOST_BASE_PATH . "index.php [L]"
  ])) === false) { exit("Failed to create $htaccess"); }
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit();
}

// @TODO - MODIFY THIS SECTION TO YOUR OWN REQUIREMENT
//  USER ACCESS PERMISSION CHECKS
//  LOAD CONTENT FROM DATABASE
//  "ADMIN PAGES ONLY"

// THIS IS A SIMPLE VERSION - WILL LOOK FOR CORRESPONDING PAGE IN PAGES/ FOLDER
// E.G. HTTP://SITE.COM/HELLO/WORLD/ > PAGES/PAGE-HELLO-WORLD.PHP

// (C) STRIP PATH DOWN TO AN ARRAY
// E.G. HTTP://SITE.COM/HELLO/WORLD/ > $_PATH = ["HELLO", "WORLD"]
$_PATH = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (substr($_PATH, 0, strlen(HOST_BASE_PATH)) == HOST_BASE_PATH) {
  $_PATH = substr($_PATH, strlen(HOST_BASE_PATH));
}
$_PATH = rtrim($_PATH, '/');
$_PATH = explode("/", $_PATH);

// (D) LOAD PAGE
$pgpath = PATH_BASE . "pages" . DIRECTORY_SEPARATOR;
$pgfile = $pgpath . "PAGE-";
$pgfile .= $_PATH[0]=="" ? "home.php" : implode("-", $_PATH) . ".php";
$pgexist = file_exists($pgfile);

if (!$pgexist) { http_response_code(404); }
require $pgpath . "TEMPLATE-top.php";
require $pgexist ? $pgfile : $pgpath . "PAGE-404.php";
require $pgpath . "TEMPLATE-bottom.php";
