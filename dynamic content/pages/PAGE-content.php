<?php
// (A) GET CONTENT
$_POST["id"] = 1;
$content = $_CORE->autoCall("Contents", "get");

// (B) OUTPUT CONTENT
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1><?=$content["content_title"]?></h1>
<?=$content["content_text"]?>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>