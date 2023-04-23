<?php
// (A) PAGE META DATA & SCRIPTS
$_PMETA = [
  "title" => "Core Boxx Tutorial Page",
  "load" => [
    ["s", HOST_ASSETS . "PAGE-items.js", "defer"]
    //,["s", HOST_ASSETS . "more.js"]
    //,["c", HOST_ASSETS . "my.css"]
  ]
];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B1) ADD ITEM -->
<form class="d-flex mb-4" onsubmit="return add()">
  <input type="text" class="form-control me-1" required id="iAdd">
  <input type="submit" class="btn btn-primary" value="Add">
</form>

<!-- (B2) LIST ITEMS -->
<ul id="iList" class="list-group"></ul>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>