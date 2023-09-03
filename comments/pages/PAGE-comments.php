<?php
// (A) PAGE META
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-comment.js", "defer"]
]];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
  <!-- (B1) DOES NOT MATTER - DUMMY PRODUCT -->
  <div class="row d-flex flex-nowrap">
    <img src="<?=HOST_ASSETS?>comment.webp" style="max-width:200px;height:auto;object-fit:cover">
    <div class="flex-shrink-1 p-3">
      <h3 class="mb-4">SMARTPHONE WITH BLUE FLOWERS</h3>
      <div class="text-secondary mb-4">
        This is a random dummy product, which is a blue smartphone.
        It is covered in blue flowers and leaves, but somehow still works.
      </div>
      <div class="text-danger fw-bold mb-4">$999,999.99 (before tax)</div>
      <button type="button" class="my-1 btn btn-primary d-flex-inline">
        <i class="ico-sm icon-cart me-1"></i> Add To Cart
      </button>
    </div>
  </div>

  <!-- (B2) COMMENTS -->
  <div class="row p-4">
    <!-- (B2-1) ADD COMMENT FORM -->
    <form class="border bg-light p-3" onsubmit="return comment.add()">
      <?php if (isset($_SESSION["user"])) { ?>
      <input type="text" class="form-control" id="cmsg" required>
      <button type="submit" class="mt-3 btn btn-primary d-flex-inline">
        <i class="ico-sm icon-bubble"></i> Comment
      </button>
      <?php } else { ?>
      To comment, please <a href="<?=HOST_BASE?>login">login</a> first.
      <?php } ?>
    </form>

    <!-- (B2-2) COMMENTS WRAPPER -->
    <div id="cwrap" class="mt-4 p-0"></div>
  </div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>