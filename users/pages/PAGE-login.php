<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B1) JAVASCRIPT -->
<script>
function signin () {
  // FORM DATA
  let data = new FormData(document.getElementById("loginform"));

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
<form onsubmit="return signin();" id="loginform">
  <label for="email">Email</label>
  <input type="email" name="email" required/>
  <label for="password">Password</label>
  <input type="password" name="password" required/>
  <input type="submit" value="Sign in"/>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
