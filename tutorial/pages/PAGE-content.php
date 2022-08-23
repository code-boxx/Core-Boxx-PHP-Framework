<?php
// (A) PAGE META DATA & SCRIPTS
$_PMETA = [
  "title" => "Core Boxx Tutorial Page",
  "load" => [
    ["s", HOST_ASSETS . "content.js", "defer"]
    //,["s", HOST_ASSETS . "more.js"]
    //,["c", HOST_ASSETS . "my.css"]
  ]
];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<input type="button" class="btn btn-primary mb-4" value="Add" onclick="content.addedit()">
<ul id="cList" class="list-group"></ul>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>