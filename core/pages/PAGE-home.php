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
<h3>IT WORKS!</h3>
<div class="mb-3">
  Here's a quick walkthrough of PHP variables that may be useful in your pages.
</div>

<!-- (A) CORE ENGINE -->
<div class="bg-primary text-white p-3">
  <strong>$_CORE</strong> - The core engine.
</div>
<div class="bg-white border p-3 mb-3"><?php print_r($_CORE); ?></div>

<!-- (B) URL PATH -->
<div class="bg-primary text-white p-3">
  <strong>$_PATH</strong> - The current path.
  You can use this to resolve things like pagination <strong>/page/123</strong>,
  or maybe a selected category <strong>/products/toys</strong>.
</div>
<div class="bg-white border p-3 mb-3"><?php echo $_PATH; ?></div>

<!-- (C) SESSION -->
<div class="bg-primary text-white p-3">
  <strong>$_SESS</strong> - "Session variables", something like the default PHP <strong>$_SESSION</strong>.
</div>
<div class="bg-white border p-3 mb-3"><?php print_r($_SESS); ?></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>