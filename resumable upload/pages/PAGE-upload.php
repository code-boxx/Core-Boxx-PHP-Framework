<?php
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."flow.min.js", "defer"],
  ["s", HOST_ASSETS."PAGE-upload.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="mb-4">RESUMABLE FILE UPLOAD DEMO</h3>
<input type="button" class="btn btn-primary" id="upbrowse" value="Browse">
<input type="button" class="btn btn-primary" id="upToggle" value="Pause OR Continue">
<div id="uplist" class="mt-4"></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>