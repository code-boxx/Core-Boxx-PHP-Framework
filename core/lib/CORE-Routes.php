<?php
/*
// (A) MANUAL PATH OVERRIDE
$override = function ($path) {
  // (A1) EXAMPLE - REDIRECT TO LOGIN PAGE IF NOT SIGNED IN
  if (!isset($_SESSION["user"]) && $path!="login/") {
    header("Location: " . HOST_BASE . "login/");
    exit();
  }

  // (A2) EXAMPLE - TWEAK PATH BASED ON USER ROLE
  if ($path=="products/" && $_SESSION["user"]["role"]=="admin") {
    $path = "admin/products/";
  }

  // (A3) RETURN OVERIDDEN PATH
  return $path;
};
*/

/*
// (B) EXACT PATH ROUTING
// EXAMPLE - HTTP://SITE.COM/ WILL LOAD PAGES/MYHOME.PHP
// EXAMPLE - HTTP://SITE.COM/MYPAGE/ WILL LOAD PAGES/MYPAGE.PHP
$routes = [
  "/" => "myhome.php",
  "mypage/" => "mypage.php",
];
*/

/*
// (C) WILDCARD PATH ROUTING
// EXAMPLE - HTTP://SITE.COM/PRODUCTS/* WILL LOAD PAGES/MYPRODUCTS.PHP
$wild = [
  "products/" => "myproducts.php"
];
*/