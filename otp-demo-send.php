<!DOCTYPE html>
<html>
  <head>
    <title>OTP Demo Step 1 - Send OTP</title>
  </head>
  <body>
    <?php
    if (isset($_POST["email"])) {
      require "lib/GO.php";
      $_CORE->load("OTP");
      echo $_CORE->OTP->generate($_POST["email"])
      ? "Email send - check email" : $_CORE->error;
    } ?>
    <form method="post">
      <input type="email" name="email" required placeholder="email" value="jon@doe.com"/>
      <input type="submit"/>
    </form>
  </body>
</html>
