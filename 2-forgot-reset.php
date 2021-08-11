<?php
require "lib/GO.php";
$_CORE->load("Forgot");
echo $_CORE->Forgot->reset($_GET['i'], $_GET['h'])
  ? "New password sent to your email" : $_CORE->error;
