<?php
// CALLED BY $_CORE->ROUTES->RESOLVE()
// USE THIS TO OVERRIDE URL PAGE ROUTES

/*
// (A) EXAMPLE - MANUAL PATH OVERRIDE
$override = function ($path) {
  // (A1) REDIRECT TO LOGIN PAGE IF NOT SIGNED IN
  if (!isset($_SESSION["user"]) && $path!="login/") {
    header("Location: " . HOST_BASE . "login/");
    exit();
  }

  // (A2) TWEAK PATH BASED ON USER ROLE
  if ($path=="products/" && $_SESSION["user"]["role"]=="admin") {
    $path = "admin/products/";
  }

  // (A3) RETURN OVERIDDEN PATH
  return $path;
};

// (B) EXAMPLE - EXACT PATH ROUTING
$routes = [
  "/" => "myhome.php", // http://site.com/ > pages/myhome.php
  "foo/" => "bar.php", // http://site.com/foo/ > pages/bar.php
];

// (C) EXAMPLE - WILDCARD PATH ROUTING
$wild = [
  "bar/" => "foo.php" // http://site.com/bar/* > pages/foo.php
];
*/