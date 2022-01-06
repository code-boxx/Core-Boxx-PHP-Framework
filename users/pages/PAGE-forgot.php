<?php require PATH_PAGES . "TEMPLATE-top.php";

// (A) PART 1 - ENTER EMAIL
if (!isset($_GET["i"]) && !isset($_GET["h"])) { ?>
<!-- (A1) JS -->
<script>
function forgot () {
  // FORM DATA
  let data = new FormData(document.getElementById("forgotform"));

  // API REQUEST
  fetch("<?=HOST_API?>session/forgotA", { method:"post", body:data })
  .then(res => res.json()).then((res) => {
    if (res.status) { alert("Click on the link in your email."); }
    else { alert(res.message); }
  });
  return false;
}
</script>

<!-- (A2) REQEST FORM -->
<form onsubmit="return forgot()" id="forgotform">
  <input type="email" name="email" required/>
  <input type="submit" value="Reset Request"/>
</form>
<?php }

// (B) PART 2 - VALIDATION
else {
$_CORE->load("Forgot");
$pass = $_CORE->Forgot->reset($_GET["i"], $_GET["h"]); ?>
<div><?php
  if ($pass) { echo "OK - New password sent to your email."; }
  else { echo $_CORE->error; }
?></div>
<?php }
require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
