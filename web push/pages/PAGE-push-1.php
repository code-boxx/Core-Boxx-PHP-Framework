<?php
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-push.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<script>var cbvapid = "<?=PUSH_PUBLIC?>";</script>
<h1>SERVICE WORKER & PERMISSION</h1>
<div id="push-stat">Allow push notifications, and let the script run in the background.</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>