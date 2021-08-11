<?php
if (isset($_POST['email'])) {
  require "lib/GO.php";
  $_CORE->load("Forgot");
  echo $_CORE->Forgot->request($_POST['email'])
    ? "Reset link sent - Check your email" : $_CORE->error;
}
?>

<form method="post">
  <input type="text" name="email" required/>
  <input type="submit" value="Reset Request"/>
</form>
