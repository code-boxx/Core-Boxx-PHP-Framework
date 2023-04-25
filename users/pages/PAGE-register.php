<?php
// (A) ALREADY SIGNED IN
if (isset($_CORE->Session->data["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-register.js"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<form class="bg-white border p-4" onsubmit="return register();">
  <h3 class="mb-4">REGISTRATION</h3>

  <div class="form-floating mb-4">
    <input type="text" id="reg-name" class="form-control" required placeholder="Name">
    <label>Name</label>
  </div>

  <div class="form-floating mb-4">
    <input type="email" id="reg-email" class="form-control" required placeholder="Email">
    <label>Email</label>
  </div>

  <div class="form-floating mb-4">
    <input type="password" id="reg-pass" class="form-control" required placeholder="Password">
    <label>Password, at least 8 characters alphanumeric.</label>
  </div>

  <div class="form-floating mb-4">
    <input type="password" id="reg-cpass" class="form-control" required placeholder="Confirm Password">
    <label>Confirm Password</label>
  </div>

  <input type="submit" class="btn btn-primary" value="Register">
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>