<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B1) JAVASCRIPT -->
<script>
function signin () {
  // FORM DATA
  let data = new FormData();
  data.append("email", document.getElementById("user_email").value);
  data.append("password", document.getElementById("user_password").value);

  // CALL API
  fetch("<?=HOST_API?>session/login", {
    method:"post", body:data
  }).then(res => res.json()).then((res) => {
    if (res.status) { location.href = "<?=HOST_BASE?>"; }
    else { alert(res.message); }
  });
  return false;
}
</script>

<!-- (B2) LOGIN FORM -->
<form onsubmit="return signin();" class="col-md-8 offset-md-2 bg-light border p-4">
<div class="row justify-content-center">
  <h4 class="mb-4">SIGN IN</h4>

  <div class="mb-4">
    <label class="form-label" for="user_email">Email</label>
    <input type="email" id="user_email" class="form-control form-control-lg" required/>
  </div>

  <div class="mb-4">
    <label class="form-label" for="user_password">Password</label>
    <input type="password" id="user_password" class="form-control form-control-lg" required/>
  </div>

  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in"/>
</div>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
