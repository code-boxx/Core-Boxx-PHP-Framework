<?php
// (A) NOT SIGNED IN
if (!isset($_CORE->Session->data["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-myaccount.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<form class="bg-white border p-4" onsubmit="return save()">
  <h3 class="mb-4">MY ACCOUNT</h3>

  <div class="form-floating mb-4">
    <input type="text" id="user-name" class="form-control" required placeholder="Name" value=<?=$_CORE->Session->data["user"]["user_name"]?>>
    <label>Name</label>
  </div>

  <div class="form-floating mb-4">
    <input type="email" id="user-email" class="form-control" required placeholder="Email" value="<?=$_CORE->Session->data["user"]["user_email"]?>">
    <label>Email</label>
  </div>

  <div class="form-floating mb-4">
    <input type="password" id="user-pass" class="form-control" required placeholder="Password">
    <label>Password, at least 8 characters alphanumeric.</label>
  </div>

  <div class="form-floating mb-4">
    <input type="password" id="user-cpass" class="form-control" required placeholder="Confirm Password">
    <label>Confirm Password</label>
  </div>

  <input type="submit" class="btn btn-primary" value="Save">
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php";