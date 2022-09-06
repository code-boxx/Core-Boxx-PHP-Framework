<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) HTML FORM -->
<h1>SEND TEST NOTIFICATION</h1>
<form method="post" class="p-4 bg-white border">
  <label class="form-label">Title</label>
  <input type="text" required class="form-control" name="title" value="Title">
  <label class="form-label">Message</label>
  <input type="text" required class="form-control" name="body" value="Message">
  <label class="form-label">Icon</label>
  <input type="text" required class="form-control" name="icon" value="<?=HOST_ASSETS?>i-loud.png">
  <label class="form-label">Image</label>
  <input type="text" required class="form-control" name="image" value="<?=HOST_ASSETS?>i-zap.png">
  <input type="submit" value="Go" class="btn btn-primary mt-4">
</form>

<?php
// (B) SEND!
if (count($_POST)>0) { $_CORE->autoCall("Push", "send"); }
require PATH_PAGES . "TEMPLATE-bottom.php"; ?>