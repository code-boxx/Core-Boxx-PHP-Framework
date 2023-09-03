<?php
// (A) PAGE META
$_PMETA = ["load" => [
  ["s", HOST_ASSETS."PAGE-stars.js", "defer"]
]];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
  <!-- (B1) DOES NOT MATTER - DUMMY PRODUCT -->
  <div class="row d-flex flex-nowrap">
    <img src="<?=HOST_ASSETS?>stars.webp" style="max-width:200px;height:auto;object-fit:cover">
    <div class="flex-shrink-1 p-3">
      <h3 class="mb-4">SHOCKINGLY BLUE ENERGY DRINK</h3>
      <div class="text-secondary mb-4">
        An energy drink that can give you temporary superhero powers.
        Handle with extreme care, wear full protection armor. Not for the faint hearted.
      </div>
      <div class="text-danger fw-bold mb-4">$999,999.99 (before tax)</div>
      <button type="button" class="my-1 btn btn-primary d-flex-inline">
        <i class="ico-sm icon-cart me-1"></i> Add To Cart
      </button>
    </div>
  </div>

  <!-- (B2) REVIEW STARS -->
  <div class="row pt-4 m-4 border-top"><?php
    // (B2-1) HELPER FUNCTION - DRAW "STAR WIDGET"
    function draw ($id, $data, $max=5) {
      // CURRENT AVERAGE RATING ?>
      <div class="flex">
        <?php
        $s = floor($data["avg"] * 2) / 2;
        for ($i=1; $i<=$max; $i++) {
          $css = $s >= $i ? "full text-danger" : (ceil($s)==$i ? "half text-danger" : "empty") ;
          echo "<i class='ico icon-star-$css'></i>";
        }
        ?>
        <div>
          Average rating of <?=$data["avg"]?> by <?=$data["num"]?> users.
        </div>
      </div>
      <?php

      // NOT SIGNED IN
      if (!isset($_SESSION["user"])) { ?>
      <div>
        To rate this product, please <a href="<?=HOST_BASE?>login">login</a> first.
      </div>
      <?php }

      // USER'S RATING
      else { ?>
      <div class="flex mt-3 stars" data-id="<?=$id?>">
        <?php
        $s = floor($data["user"] * 2) / 2;
        for ($i=1; $i<=$max; $i++) {
          $css = $s >= $i ? "full text-danger" : (ceil($s)==$i ? "half text-danger" : "empty") ;
          echo "<i class='ico icon-star-$css'></i>";
        }
        ?>
        <div>Your rating.</div>
      </div>
      <?php }
    }

    // (B2-2) DRAW!
    $pid = 999; // fixed dummy product id for demo
    $_CORE->load("Stars");
    draw($pid, $_CORE->Stars->get($pid));
  ?></div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php";