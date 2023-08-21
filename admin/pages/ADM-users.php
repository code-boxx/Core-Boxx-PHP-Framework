<?php
// (A) PAGE META
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."ADM-users.js", "defer"]
]];

// (B) HTML
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<!-- (B1) HEADER -->
<h3 class="mb-3">MANAGE USERS</h3>

<!-- (B2) SEARCH BAR -->
<form class="d-flex align-items-stretch head border mb-3 p-2" onsubmit="return usr.search()">
  <input type="text" id="user-search" placeholder="Search" class="form-control form-control-sm">
  <button type="submit" class="btn btn-primary p-3 mx-1 ico-sm icon-search"></button>
  <button type="button" class="btn btn-primary p-3 ico-sm icon-plus" onclick="usr.addEdit()"></button>
</form>

<!-- (B3) USERS LIST -->
<div id="user-list" class="zebra my-4"></div>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>