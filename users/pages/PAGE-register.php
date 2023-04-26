<?php
// (A) ALREADY SIGNED IN
if (isset($_CORE->Session->data["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-register.js"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
<div class="row">
  <div class="col-3" style="background:url('<?=HOST_ASSETS?>acct.webp') center;background-size:cover"></div>
  <form class="col-9 p-4" onsubmit="return register();">
    <img src="<?=HOST_ASSETS?>favicon.png" class="p-2 rounded-circle" style="background:#f1f1f1">
    <h3 class="my-4">REGISTRATION</h3>
    <div class="form-floating mb-4">
      <input type="text" id="reg-name" class="form-control" required>
      <label>Name</label>
    </div>

    <div class="form-floating mb-4">
      <input type="email" id="reg-email" class="form-control" required>
      <label>Email</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="reg-pass" class="form-control" required>
      <label>Password, at least 8 characters alphanumeric.</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="reg-cpass" class="form-control" required>
      <label>Confirm Password</label>
    </div>

    <div class="d-flex align-items-center">
      <div class="flex-grow-1">
        <input type="submit" class="btn btn-primary" value="Register">
      </div>
      <a href="<?=HOST_BASE?>activate">Resend activation link?</a>
    </div>
  </form>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>