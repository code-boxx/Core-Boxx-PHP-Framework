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

  <div class="form-floating mb-4">
    <input type="email" id="oemail" class="form-control" required>
    <label>Email</label>
  </div>

  <div class="form-floating mb-4">
    <input type="password" id="opass" class="form-control" required>
    <label>Password</label>
  </div>

  <button type="submit" class="my-1 btn btn-primary d-flex-inline align-items-center justify-content-center">
    <i class="ico-sm icon-checkmark me-1"></i> Go
  </button>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>