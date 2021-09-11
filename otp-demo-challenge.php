<!DOCTYPE html>
<html>
  <head>
    <title>OTP Demo Step 2 - Verify OTP</title>
  </head>
  <body>
    <?php
    if (isset($_POST["email"])) {
      require "lib/GO.php";
      $_CORE->load("OTP");
      echo $_CORE->OTP->challenge($_POST["email"], $_POST["otp"])
      ? "Challenge OK - Do something" : $_CORE->error;
    } ?>
    <form method="post">
      <input type="email" name="email" required placeholder="email" value="jon@doe.com"/>
      <input type="password" name="otp" required placeholder="otp"/>
      <input type="submit"/>
    </form>
  </body>
</html>
