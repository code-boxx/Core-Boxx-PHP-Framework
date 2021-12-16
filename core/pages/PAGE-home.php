<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1>IT WORKS!</h1>

<p>Every page has <code>$_CORE</code> - The core engine.</p>
<?php print_r($_CORE); ?>

<p>
  Every page also has <code>$_PATH</code> - The current relevant path
  (if you want to use for something like /page/123).
</p>
<?php echo $_PATH; ?>

<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
