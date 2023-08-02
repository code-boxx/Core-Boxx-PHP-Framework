<?php
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-comment.js", "defer"]
]];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) COMMENTS -->
<h3 class="mb-4">COMMENTS DEMO</h3>
<div id="cwrap" class="mb-3"></div>

<!-- (B) ADD COMMENT -->
<?php if (isset($_SESSION["user"])) { ?>
<form class="border p-4" onsubmit="return comment.add()">
  <input type="text" class="form-control" id="cmsg" required>
  <input type="submit" class="btn btn-primary mt-3" value="Comment">
</form>
<?php } else { ?>
<div>
  Please <a href="<?=HOST_BASE?>login">login</a> first.
</div>
<?php }
require PATH_PAGES . "TEMPLATE-bottom.php"; ?>