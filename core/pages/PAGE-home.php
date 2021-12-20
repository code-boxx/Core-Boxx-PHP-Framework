<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<style>
h1, .demoA, .demoB { font-family:arial, sans-serif; }
code { background:#f9ff9f; }
.demoA, .demoB { font-size:18px; padding:20px; margin:10px 0; }
.demoA { background:#ffdede; }
.demoB { background:#f1f1f1; }
</style>

<h1>IT WORKS!</h1>
<div class="demoA">
  Every page has <code>$_CORE</code> - The core engine.
</div>
<div class="demoB"><?php print_r($_CORE); ?></div>

<div class="demoA">
  Every page also has <code>$_PATH</code> - The current relevant path
  (if you want to use for something like /page/123).
</div>
<div class="demoB"><?php echo $_PATH; ?></div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
