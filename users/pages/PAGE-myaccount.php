<?php
// (A) NOT SIGNED IN
if (!isset($_SESSION["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-myaccount.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
<div class="row">
  <div class="col-3" style="background:url('<?=HOST_ASSETS?>acct.webp') center;background-size:cover"></div>
  <form class="col-9 p-4" onsubmit="return save();">
    <img src="<?=HOST_ASSETS?>favicon.png" class="p-2 rounded-circle" style="background:#f1f1f1">
    <h3 class="mb-4">MY ACCOUNT</h3>
    <div class="form-floating mb-4">
      <input type="text" id="user-name" class="form-control" required value=<?=$_SESSION["user"]["user_name"]?>>
      <label>Name</label>
    </div>

    <div class="form-floating mb-4">
      <input type="email" class="form-control" readonly value="<?=$_SESSION["user"]["user_email"]?>">
      <label>Email</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="user-cpass" class="form-control" required>
      <label>Current Password</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="user-npass" class="form-control" required>
      <label>New Password, at least 8 characters alphanumeric.</label>
    </div>

    <div class="form-floating mb-4">
      <input type="password" id="user-ncpass" class="form-control" required>
      <label>Confirm Password</label>
    </div>

    <input type="submit" class="btn btn-primary" value="Save">
  </form>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php";