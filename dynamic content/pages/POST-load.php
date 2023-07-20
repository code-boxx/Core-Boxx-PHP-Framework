<?php
// (A) PATH
$_PATH = explode("/", rtrim($_CORE->Route->path, "/"));
if (count($_PATH)!=2) {
  $_CORE->Route->load("PAGE-404.php", 404); exit();
}

// (B) LOAD CONTENT FROM DATABASE
$_CORE->load("Contents");
$content = $_CORE->Contents->get($_PATH[1]);

// (C) NOT FOUND
if (!is_array($content)) {
  $_CORE->Route->load("PAGE-404.php", 404); exit();
}

// (D) GENERATE PAGE
$_PMETA = [
  "title" => $content["content_title"]
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1><?=$content["content_title"]?></h1>
<?=$content["content_text"]?>
<?php require PATH_PAGES . "TEMPLATE-bottom.php";