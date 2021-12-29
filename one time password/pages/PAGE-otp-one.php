<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) JS -->
<script>
function otp () {
  // FORM DATA
  var data = new FormData(document.getElementById("otpform"));

  // API CALL
  fetch("<?=HOST_API?>otp/generate", { method:"post", body:data })
  .then(res => res.json()).then((res) => {
    if (res.status) { alert("Check your email"); }
    else { alert(res.message); }
  });
  return false;
}
</script>

<h1>Request OTP</h1>
<form onsubmit="return otp()" id="otpform">
  <input type="email" name="email" required/>
  <input type="submit" value="Go"/>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
