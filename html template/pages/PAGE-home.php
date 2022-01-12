<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3 class="mb-3">IT WORKS!</h3>

<!-- (A) CORE ENGINE -->
<div class="bg-primary text-white p-3">
  Every page has <strong>$_CORE</strong> - The core engine.
</div>
<div class="bg-white border p-3 mb-3"><?php print_r($_CORE); ?></div>

<!-- (B) URL PATH -->
<div class="bg-primary text-white p-3">
  <strong>$_PATH</strong> - The current relevant path.
  You can use this to resolve things like pagination <strong>/page/123</strong>,
  or maybe a selected category <strong>/products/toys</strong>.
</div>
<div class="bg-white border p-3 mb-3"><?php echo $_PATH; ?></div>

<!-- (C) SESSION -->
<div class="bg-primary text-white p-3">
  <strong>$_SESS</strong> - Something like the default PHP <strong>$_SESSION</strong>.
</div>
<div class="bg-white border p-3 mb-3"><?php print_r($_SESS); ?></div>

<!-- (D) PAGE -->
<div class="bg-primary text-white p-3">
  <strong>$_PAGE</strong> - Current physical file.
</div>
<div class="bg-white border p-3 mb-3"><?=$_PAGE?></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
