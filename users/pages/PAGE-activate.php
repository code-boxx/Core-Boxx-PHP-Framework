<?php
// (A) ACCOUNT ACTIVATION
if (isset($_GET["i"]) && isset($_GET["h"])) {
  $valid = $_CORE->autocall("Users", "hactivate", "GET");
}

// (B) HTML PAGE
$_PMETA = ["load" => [["s", HOST_ASSETS."PAGE-activate.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-6 bg-white">
<div class="row">
  <form class="col-8 p-4" onsubmit="return activate();">
    <?php
    // (B1) ACCOUNT ACTIVATION
    if (isset($valid)) { ?>
    <h3 class="mb-4"><?=$valid?"YES!":"OPPS..."?></h3>
    <div class="mb-4"><?=$valid?"Your account has been activated.":$_CORE->error?></div>

    <div class="text-secondary mt-3">
      <a href="<?=HOST_BASE?>">Home</a>
    </div>
    <?php }

    // (B2) RESEND ACTIVATION LINK
    else { ?>
    <h3 class="m-0">RESEND ACTIVATION LINK</h3>
    <div class="mb-4 text-secondary"><small>
      Enter your email below, an activation link will be sent.
    </small></div>
    <div class="form-floating mb-4">
      <input type="email" id="activate-email" class="form-control" required>
      <label>Email</label>
    </div>
    <button type="submit" class="my-1 btn btn-primary d-flex-inline">
      <i class="ico-sm icon-envelop"></i> Send
    </button>

    <div class="text-secondary mt-3">
      <a href="<?=HOST_BASE?>register">Back To Registration</a>
    </div>
    <?php } ?>
  </form>
  <div class="col-4" id="login-r" style="background:url('<?=HOST_ASSETS?>users.webp') center;"></div>
</div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>