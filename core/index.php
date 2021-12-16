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
