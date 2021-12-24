<?php
/*********** DELETE THIS SECTION AFTER INIT ************/
echo implode("<br>\r\n", [
  "Please make sure that you have:",
  "1) Changed the settings in lib/CORE-config.php to your own",
  "2) Reload this script to generate .htaccess and api/.htaccess",
  "3) Open index.php and remove this section",
  "4) Highly recommended to go through the mini tutorial - <a href='https://code-boxx.com/core-boxx-php-rapid-development-framework/'>Core Boxx</a>"
]);

require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-go.php";
$_CORE->load("Route");
$_CORE->Route->init();
exit();
/*********** DELETE THIS SECTION AFTER INIT ************/

// (A) LOAD CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "CORE-go.php";
$_CORE->load("Route");

/* (B) ADD YOUR OWN MANUAL ROUTES IF YOU WANT *
$_CORE->Route->set([
  "/" => "myhome.php",
  "mypage/" => "page.php",
  "products/*" => "myproducts.php"
]);

/* (C) OR YOUR OWN PATH OVERRIDE
$_CORE->Route->run(function ($_PATH) {
  // REDIRECT TO LOGIN PAGE IF NOT SIGNED IN
  if (!isset($_SESSION["user"]) && $_PATH!="/login") {
    header("Location: ".HOST_BASE."login");
    exit();
  }

  // TWEAK PATH BASED ON USER ROLE
  if ($_PATH=="/products" && $_SESSION["user"]["role"]=="admin") {
    $_PATH = "/admin/products";
  }

  // MUST RETURN $_PATH
  return $_PATH;
}); */

// (D) AUTO RESOLVE ROUTE
$_CORE->Route->run();
