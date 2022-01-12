<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<style>.demoA,.demoB,h1{font-family:arial,sans-serif}code{background:#f9ff9f}.demoA,.demoB{font-size:18px;padding:20px;margin:10px 0}.demoA{background:#ffdede}.demoB{background:#f1f1f1}</style>
<h1>IT WORKS!</h1>

<!-- (A) CORE ENGINE -->
<div class="demoA">
  Every page has <code>$_CORE</code> - The core engine.
</div>
<div class="demoB"><?php print_r($_CORE); ?></div>

<!-- (B) URL PATH -->
<div class="demoA">
  <code>$_PATH</code> - The current relevant path.
  You can use this to resolve things like pagination <code>/page/123</code>,
  or maybe a selected category <code>/products/toys</code>.
</div>
<div class="demoB"><?php echo $_PATH; ?></div>

<!-- (C) SESSION -->
<div class="demoA">
  <code>$_SESS</code> - Something like the default PHP <code>$_SESSION</code>.
</div>
<div class="demoB"><?php print_r($_SESS); ?></div>

<!-- (D) PAGE -->
<div class="demoA">
  <code>$_PAGE</code> - Current physical file.
</div>
<div class="demoB"><?=$_PAGE?></div>

<!-- (E) HTML MODULE LINK -->
<div class="demoA">
  This is ugly? Check the <a href="https://code-boxx.com/core-boxx-html-javascript-template/" target="_blank">Core Boxx HTML template</a>.
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
