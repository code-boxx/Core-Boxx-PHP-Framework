<?php
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."flow.min.js", "defer"],
  ["s", HOST_ASSETS."PAGE-upload.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) SELECT FILE & PAUSE/RESUME -->
<h3 class="mb-4">RESUMABLE FILE UPLOAD DEMO</h3>
<button type="button" class="my-1 btn btn-primary d-flex-inline" id="upbrowse">
  <i class="ico-sm icon-file-empty me-1"></i> Select File
</button>

<button type="button" class="my-1 btn btn-primary d-flex-inline" id="uptoggle">
  <i class="ico-sm icon-play3 me-1"></i> Pause/Resume
</button>

<!-- (B) UPLOAD LIST -->
<div id="uplist" class="mt-4"></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>