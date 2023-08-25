<?php
$_PMETA = [
  "load" => [
    ["l", HOST_ASSETS."PAGE-reactions.css"],
    ["s", HOST_ASSETS."PAGE-reactions.js", "defer"]
  ]
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="row justify-content-center">
<div class="col-md-10 bg-white border">
  <div class="row d-flex flex-nowrap">
    <!-- DOES NOT MATTER - DUMMY PRODUCT -->
    <img src="<?=HOST_ASSETS?>reactions.webp" style="max-width:200px;height:auto;object-fit:cover">
    <div class="flex-shrink-1 p-3">
      <h3 class="mb-4">SOME EXPENSIVE PERFUME THAT LOOKS LIKE WINE</h3>
      <div class="text-secondary mb-4">
        We put perfume into an expensive looking bottle and did some marketing.
        It's highly overpriced, but people still like it abd buy for some reason.
      </div>
      <div class="text-danger fw-bold mb-4">$999,999.99 (before tax)</div>
      <button type="button" class="mb-4 btn btn-primary d-flex-inline">
        <i class="ico-sm icon-cart"></i> Add To Cart
      </button>

      <!-- REACTIONS WIDGET -->
      <div id="reactions" class="d-flex align-items-center pt-3 border-top"><?php
      // (A) "SETTINGS"
      $pid = 999; // fixed dummy product id for this example
      $code = [
        // reaction code => icon
        1 => "icon-heart",       // like
        2 => "icon-heart-broken" // dislike
        // add more reactions if you want
        // 3 => "icon-star-full" // star
        // 4 => "icon-fire"      // fire
        // 4 => "icon-power"     // power
      ];

      // (B) GET REACTIONS
      $_CORE->load("Reactions");
      $reactions = $_CORE->Reactions->get($pid);

      // (C) DRAW "REACTIONS WIDGET"
      printf("<input type='hidden' id='pid' value='%u'>", $pid);
      foreach ($code as $cid=>$icon) {
        printf("<div id='reaction%u' data-rid='%u' class='me-3 reaction' role='button'%s>
          <i class='me-2 ico %s%s'></i> <i class='count'>%u</i>
        </div>",
          $cid, $cid, isset($_SESSION["user"]) ? " onclick='reaction($cid)'" : "",
          $icon, $reactions["user"]==$cid ? " set" : "" ,
          isset($reactions["react"][$cid]) ? $reactions["react"][$cid] : 0
        );
      }
      ?></div>
    </div>
  </div>
</div>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>