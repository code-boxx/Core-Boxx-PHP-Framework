<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-register.js"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<form class="bg-white border p-4" onsubmit="return register();">
  <h3 class="mb-4">REGISTRATION</h3>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">person</span>
    </div>
    <input type="text" id="reg-name" class="form-control" required placeholder="Name">
  </div>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">email</span>
    </div>
    <input type="email" id="reg-email" class="form-control" required placeholder="Email">
  </div>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">password</span>
    </div>
    <input type="password" id="reg-pass" class="form-control" required placeholder="Password">
  </div>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">password</span>
    </div>
    <input type="password" id="reg-cpass" class="form-control" required placeholder="Confirm Password">
  </div>

  <input type="submit" class="btn btn-primary" value="Register">
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>