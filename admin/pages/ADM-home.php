<?php
$_PMETA = [
  "title" => "Core Boxx Admin Page",
  "desc" => "Optional Description",
  /* OPTIONAL - LOAD EXTRA SCRIPTS
  "load" => [
    ["s", HOST_ASSETS."some.js"],
    ["s", HOST_ASSETS."somemore.js", "defer"],
    ["c", HOST_ASSETS."some.css"],
  ]
  */
];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<h3 class="mb-3">IT WORKS!</h3>
<p>Build your own dashboard here.</p>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>