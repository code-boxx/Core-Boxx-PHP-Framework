<?php
// (A) DELETE DEMO PAGES
foreach (["html", "icomoon", "php"] as $file) {
  $file = PATH_PAGES . "PAGE-demo-$file.php"; 
  if (file_exists($file)) { unlink($file); }
}

// (B) DELETE SCREENSHOTS
for ($i=1; $i<=6; $i++) {
  $file = PATH_ASSETS . "core-boxx-$i.png"; 
  if (file_exists($file)) { unlink($file); }
}

// (C) REPLACE HOME PAGE WITH EMPTY PAGE
$page = <<<EOF
<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
YOUR CONTENT HERE
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
EOF;
file_put_contents(PATH_PAGES . "PAGE-home.php", $page);

// (D) DELETE THIS SCRIPT
unlink(PATH_PAGES . "PAGE-demo-clean.php");

// (E) RELOAD!
$_CORE->redirect();