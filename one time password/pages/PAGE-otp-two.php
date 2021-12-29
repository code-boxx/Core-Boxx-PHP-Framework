<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) JS -->
<script>
function otp () {
  // FORM DATA
  var data = new FormData(document.getElementById("otpform"));

  // API CALL
  fetch("<?=HOST_API?>otp/challenge", { method:"post", body:data })
  .then(res => res.json()).then((res) => {
    if (res.status) { alert("VERIFIED - DO SOMETHING"); }
    else { alert(res.message); }
  });
  return false;
}
</script>

<h1>Verify OTP</h1>
<form onsubmit="return otp()" id="otpform">
  <input type="email" name="email" required/>
  <input type="password" name="pass" required/>
  <input type="submit" value="Go"/>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
