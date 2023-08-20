<?php
// (A) DELETE DEMO PAGES
foreach ([
  "html", "icomoon", "php",
  "tut", "tut-1", "tut-2", "tut-3", "tut-4", "tut-5", "tut-6"
] as $file) {
  $file = PATH_PAGES . "PAGE-demo-$file.php"; 
  if (file_exists($file)) { unlink($file); }
}

// (B) DELETE THE TUTORIAL JS
$file = PATH_ASSETS . "PAGE-tut.js"; 
if (file_exists($file)) { unlink($file); }

// (C) DELETE SCREENSHOTS
for ($i=1; $i<=5; $i++) {
  $file = PATH_ASSETS . "core-boxx-$i.png"; 
  if (file_exists($file)) { unlink($file); }
}

// (D) REPLACE HOME PAGE WITH EMPTY PAGE
$page = <<<EOF
<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
YOUR CONTENT HERE
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
EOF;
file_put_contents(PATH_PAGES . "PAGE-home.php", $page);

// (E) DELETE THIS SCRIPT
unlink(PATH_PAGES . "PAGE-demo-clean.php");

// (F) RELOAD!
$_CORE->redirect();