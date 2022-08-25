<?php
$_PMETA = [
  "load" => [
    ["c", HOST_ASSETS."lidi.css"],
    ["s", HOST_ASSETS."lidi.js", "defer"],
    ["s", HOST_ASSETS."PAGE-reacts.js", "defer"]
  ]
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="mb-4">LIKE/DISLIKE DEMO</h3>
<div id="demo"></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>