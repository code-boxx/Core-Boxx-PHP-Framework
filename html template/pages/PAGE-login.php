<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-login.js"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<form class="bg-white border p-4" onsubmit="return login();">
  <h3 class="mb-4">LOGIN</h3>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">email</span>
    </div>
    <input type="email" id="login-email" class="form-control" required placeholder="Email"/>
  </div>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">password</span>
    </div>
    <input type="password" id="login-pass" class="form-control" required placeholder="Password"/>
  </div>

  <input type="submit" class="btn btn-primary" value="Register"/>
  <div class="py-3">
    <a href="<?=HOST_BASE?>forgot">Forgot Password</a>
  </div>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
