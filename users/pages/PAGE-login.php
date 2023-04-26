<?php
// (A) ALREADY SIGNED IN
if (isset($_CORE->Session->data["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-login.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
<div class="row">
  <div class="col-3" style="background:url('<?=HOST_ASSETS?>login.webp') center;background-size:cover"></div>
  <form class="col-9 p-4" onsubmit="return login();">
    <img src="<?=HOST_ASSETS?>favicon.png" class="p-2 rounded-circle" style="background:#f1f1f1">
    <h3 class="my-4">PLEASE SIGN IN</h3>

    <div class="form-floating mb-4">
      <input type="email" id="login-email" class="form-control" required>
      <label>Email</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="login-pass" class="form-control" required>
      <label>Password</label>
    </div>

    <input type="submit" class="btn btn-primary py-2 mb-4" value="Sign In">
    <div><a href="<?=HOST_BASE?>forgot">Forgot Password</a></div>
  </form>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>