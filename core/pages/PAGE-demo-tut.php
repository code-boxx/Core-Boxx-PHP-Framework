<?php
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-tut.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) HEADER -->
<h1 class="mb-2">VERY FAST TUTORIAL</h1>
<div class="progress mb-4">
  <div id="pb" class="progress-bar" role="progressbar"></div>
</div>

<!-- (B) CURRENT SLIDE -->
<div id="tut"></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>