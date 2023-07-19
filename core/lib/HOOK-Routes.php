<?php
// CALLED BY $_CORE->ROUTES->RESOLVE()
// USE THIS TO OVERRIDE URL PAGE ROUTES

// (A) EXACT PATH ROUTING
$routes = [
  // EXAMPLES
  // "/" => "myhome.php", // http://site.com/ > pages/myhome.php
  // "foo/" => "bar.php", // http://site.com/foo/ > pages/bar.php
];

// (B) WILDCARD PATH ROUTING
$wild = [
  // EXAMPLE
  // "category/" => "category.php", // http://site.com/category/* > pages/category.php
];

/*
// (C) MANUAL PATH OVERRIDE
$override = function ($path) {
  // EXAMPLE - REDIRECT TO LOGIN PAGE IF NOT SIGNED IN
  global $_CORE;
  if (!isset($_SESSION["user"]) && $path!="login/") {
    header("Location: " . HOST_BASE . "login/");
    exit();
  }

  // EXAMPLE - TWEAK PATH BASED ON USER ROLE
  if ($path=="products/" && $_SESSION["user"]["role"]=="admin") {
    $path = "admin/products/";
  }

  // MUST RETURN OVERIDDEN PATH
  return $path;
};
*/