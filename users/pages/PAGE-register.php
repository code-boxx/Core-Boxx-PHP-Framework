<?php
// (A) ALREADY SIGNED IN
if (isset($_SESSION["user"])) { $_CORE->redirect(); }

// (B) PAGE META & SCRIPTS
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-register.js"]
]];

// (C) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<?php if ($_CORE->error!="") { ?>
<!-- (C1) ERROR MESSAGE -->
<div class="p-2 mb-3 text-light bg-danger"><?=$_CORE->error?></div>  
<?php } ?>

<div class="row justify-content-center">
<div class="col-md-6 bg-white">
<div class="row">
  <div class="col-8 p-4">
    <h3 class="m-0">REGISTRATION</h3>
    <div class="mb-4 text-secondary"><small>
      Create a new account.
    </small></div>

    <!-- (C2) REGISTRATION FORM -->
    <form onsubmit="return register();">
      <div class="form-floating mb-4">
        <input type="text" id="reg-name" class="form-control" required>
        <label>Name</label>
      </div>

      <div class="form-floating mb-4">
        <input type="email" id="reg-email" class="form-control" required>
        <label>Email</label>
      </div>

      <div class="form-floating mb-1">
        <input type="password" id="reg-pass" class="form-control" required>
        <label>Password</label>
      </div>
      <div class="mb-4 text-secondary">* At least 8 alphanumeric characters.</div>

      <div class="form-floating mb-4">
        <input type="password" id="reg-cpass" class="form-control" required>
        <label>Confirm Password</label>
      </div>

      <button type="submit" class="my-1 btn btn-primary d-flex-inline">
        <i class="ico-sm icon-checkmark"></i> Register
      </button>
    </form>

    <!-- (C3) SOCIAL REGISTER -->

    <!-- (C4) LOGIN & FORGOT -->
    <div class="text-secondary mt-3">
      <a href="<?=HOST_BASE?>login">Login</a> |
      <a href="<?=HOST_BASE?>activate">Resend Activation</a>
    </div>
  </div>
  <div class="col-4" id="login-r" style="background:url('<?=HOST_ASSETS?>users.webp') center;"></div>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>