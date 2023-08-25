<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) JS -->
<script>
function otp () {
  cb.api({
    mod: "otp", act : "generate",
    data : { "email" : document.getElementById("oemail").value },
    passmsg : false,
    onpass : () => cb.modal("Success", "Please check your email")
  });
  return false;
}
</script>

<!-- (B) REQUEST OTP FORM -->
<form class="bg-white border p-4" onsubmit="return otp()">
  <h3 class="mb-4">REQUEST FOR OTP</h3>

  <div class="form-floating mb-4">
    <input type="email" id="oemail" class="form-control" required>
    <label>Email</label>
  </div>

  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-checkmark"></i> Go
  </button>
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>