<?php
$_PMETA = [
  "title" => "Core Boxx Demo Page",
  "desc" => "Optional Description",
  /* OPTIONAL - LOAD EXTRA SCRIPTS
  "load" => [
    ["s", HOST_ASSETS."some.js"],
    ["s", HOST_ASSETS."somemore.js", "defer"],
    ["c", HOST_ASSETS."some.css"],
  ]
  */
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-4">IT WORKS! WHAT'S NEXT?</h1>
<ol class="list-group list-group-numbered mb-4">
  <li class="list-group-item"><a href="<?=HOST_BASE?>tut/1">Very Fast Tutorial</a></li>
  <li class="list-group-item"><a href="<?=HOST_BASE?>demo">HTML Interface Demo Page</a></li>
  <li class="list-group-item"><a target="_blank" href="https://code-boxx.com/core-boxx-php-framework/">Core Boxx Official Page</a></li>
  <li class="list-group-item"><a href="<?=HOST_BASE?>about">About</a></li>
</ol>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>