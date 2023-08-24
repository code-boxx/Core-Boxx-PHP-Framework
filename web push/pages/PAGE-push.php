<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) PUSH NOTIFICATION JS  -->
<script>var cbvapid = "<?=PUSH_PUBLIC?>";</script>
<script defer src="<?=HOST_ASSETS?>PAGE-push.js"></script>

<!-- (B) PAGE HEADER -->
<h1>PUSH NOTIFICATION DEMO</h1>
<div id="push-stat" class="p-2 bg-danger text-white">
  Please allow push notifications - It may take a while to load and register.
</div>

<!-- (C) TEST FORM -->
<form method="post" class="my-4 p-4 bg-white border">
  <div class="form-floating mb-4">
    <input type="text" required class="form-control" name="title" value="Title">
    <label>Title</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" required class="form-control" name="body" value="Message">
    <label class="form-label">Message</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" required class="form-control" name="icon" value="<?=HOST_ASSETS?>ico-512.png">
    <label class="form-label">Icon</label>
  </div>

  <div class="form-floating mb-4">
    <input type="text" required class="form-control" name="image" value="<?=HOST_ASSETS?>head-core-boxx.webp">
    <label class="form-label">Image</label>
  </div>

  <button type="submit" class="my-1 btn btn-primary d-flex-inline">
    <i class="ico-sm icon-arrow-right me-1"></i> Send!
  </button>
</form>

<?php
// (D) SEND!
if (count($_POST)>0) {
  echo "<div class='mt-4 p-2 bg-success text-white'>SENDING...</div>";
  $_CORE->autoCall("Push", "send");
}

require PATH_PAGES . "TEMPLATE-bottom.php"; ?>