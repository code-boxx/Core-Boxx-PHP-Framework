<?php
// (A) ALREADY SIGNED IN
if (isset($_SESS["user"])) { $_CORE->redirect(); }

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B1) JAVASCRIPT -->
<script>
function register () {
  // FORM DATA
  let data = new FormData(document.getElementById("regform"));

  // CALL API
  fetch("<?=HOST_API?>session/register", {
    method:"post", body:data
  }).then(res => res.json()).then((res) => {
    alert(res.message);
  });
  return false;
}
</script>

<!-- (B2) REGISTRATION FORM -->
<form onsubmit="return register();" id="regform">
  <label for="name">Name</label>
  <input type="text" name="name" required/>
  <label for="email">Email</label>
  <input type="email" name="email" required/>
  <label for="password">Password</label>
  <input type="password" name="password" required/>
  <input type="submit" value="Register"/>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
