<?php
// (A) LOAD CORE ENGINE
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "GO.php";
$_CORE->load("Route");

// (B) ADD YOUR MANUAL ROUTES
// $_CORE->Route->add("/", "myhome.php");
// $_CORE->Route->add("mypage/", "page.php");
// $_CORE->Route->add("products/*", "myproducts.php");

// (C) AUTO RESOLVE ROUTE
$_CORE->Route->run();

/* (C) URL RESOLVE HOOK - FIRES BEFORE RESOLVING PATH-TO-FILE
// USE THIS TO DO PERMISSION CHECK OR TWEAK PATH
$_CORE->Route->run(function ($_PATH) {
  // EXAMPLE - TO LOGIN PAGE IF NOT SIGNED IN
  if (!isset($_SESSION["user"]) && $_PATH!="/login") {
    header("Location: ".HOST_BASE."login");
    exit();
  }

  // EXAMPLE - TWEAK PATH BASED ON USER ROLE
  if ($_PATH=="/products" && $_SESSION["user"]["role"]=="admin") {
    $_PATH = "/admin/products";
  }

  return $_PATH;
});
*/
