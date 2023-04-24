<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) JS -->
<script>
function otp () {
  cb.api({
    mod: "otp", act : "challenge", data : {
      "email" : document.getElementById("oemail").value,
      "pass" : document.getElementById("opass").value
    },
    passmsg : false,
    onpass : () => cb.modal("Verified", "@TODO - Proceed to do something.")
  });
  return false;
}
</script>

<!-- (B) VERIFY OTP FORM -->
<form class="bg-white border p-4" onsubmit="return otp()">
  <h3 class="mb-4">VERIFY OTP</h3>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">email</span>
    </div>
    <input type="email" id="oemail" class="form-control" placeholder="Email" required>
  </div>

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">password</span>
    </div>
    <input type="password" id="opass" class="form-control" placeholder="Password" required>
  </div>

  <input type="submit" class="btn btn-primary" value="Go">
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>