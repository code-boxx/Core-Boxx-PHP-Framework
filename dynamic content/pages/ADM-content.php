<?php
// (A) PAGE META
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."tinymce/tinymce.min.js", "defer"],
  ["s", HOST_ASSETS."ADM-content.js", "defer"]
]];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<!-- (B1) HEADER -->
<h3 class="mb-3">MANAGE CONTENTS</h3>

<!-- (B2) SEARCH BAR -->
<form class="d-flex align-items-stretch head border mb-3 p-2" onsubmit="return content.search()">
  <input type="text" id="content-search" placeholder="Search" class="form-control form-control-sm">
  <button type="submit" class="btn btn-primary p-3 mx-1 ico-sm icon-search"></button>
  <button type="button" class="btn btn-primary p-3 ico-sm icon-plus" onclick="content.addEdit()"></button>
</form>

<!-- (B3) CONTENTS LIST -->
<div id="content-list" class="zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>