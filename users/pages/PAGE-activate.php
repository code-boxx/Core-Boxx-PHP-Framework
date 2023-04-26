<?php
// (A) ACCOUNT ACTIVATION
if (isset($_GET["i"]) && isset($_GET["h"])) {
  $valid = $_CORE->autocall("Users", "hactivate", "GET");
}

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-activate.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
<div class="row">
  <div class="col-3" style="background:url('<?=HOST_ASSETS?>acct.webp') center;background-size:cover"></div>
  <form class="col-9 p-4" onsubmit="return activate();">
    <img src="<?=HOST_ASSETS?>favicon.png" class="p-2 rounded-circle" style="background:#f1f1f1">
    <?php
    // (B1) ACCOUNT ACTIVATION
    if (isset($valid)) { ?>
    <h3 class="my-4"><?=$valid?"YES!":"OPPS..."?></h3>
    <div class="mb-4"><?=$valid?"Your account has been activated.":$_CORE->error?></div>
    <a href="<?=HOST_BASE?>">Back To Home Page</a>
    <?php }

    // (B2) RESEND ACTIVATION LINK
    else { ?>
    <h3 class="my-4">RESEND ACTIVATION LINK</h3>
    <div class="mb-4">Enter your email below, an activation link will be sent.</div>
    <div class="form-floating mb-4">
      <input type="email" id="activate-email" class="form-control" required>
      <label>Email</label>
    </div>
    <input type="submit" class="btn btn-primary py-2 mb-4" value="Send">
    <div><a href="<?=HOST_BASE?>register">Registration page</a></div>
    <?php } ?>
  </form>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>