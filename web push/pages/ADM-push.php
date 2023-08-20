<?php
$_PMETA = ["load" => [["s", HOST_ASSETS."ADM-push.js", "defer"]]];
require PATH_PAGES . "TEMPLATE-ADM-top.php"; ?>
<h3 class="mb-3">SEND PUSH NOTIFICATION</h3>
<form id="push_form" class="bg-white border p-4 mb-3" onsubmit="return send()">
  <div class="form-floating mb-4">
    <input type="text" class="form-control" id="push_title" required>
    <label>Title</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" id="push_txt" required>
    <label>Message</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" id="push_ico" required value="<?=HOST_ASSETS?>ico-512.png">
    <label>Icon</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" class="form-control" id="push_img" required value="<?=HOST_ASSETS?>head-core-boxx.webp">
    <label>Cover Image</label>
  </div>

  <button type="submit" class="my-1 btn btn-primary d-flex-inline align-items-center justify-content-center">
    <i class="ico-sm icon-arrow-right me-1"></i> Send
  </button>
</form>
<?php require PATH_PAGES . "TEMPLATE-ADM-bottom.php"; ?>