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

  <div class="input-group mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text mi">email</span>
    </div>
    <input type="email" id="oemail" class="form-control" placeholder="Email" required>
  </div>

  <input type="submit" class="btn btn-primary" value="Go">
</form>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>