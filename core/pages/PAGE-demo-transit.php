<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-0">TRANSITIONS</h1>
<div class="text-secondary mb-4">
  these will show/hide with transition for browsers that support the view transitions api
</div>

<div class="bg-white border p-4 mb-4" id="demo">
  <div class="p-3 m-1 bg-dark text-white">
    Fade <small>(DEFAULT)</small>
  </div>
  <div class="p-3 m-1 bg-danger text-white tran-x">
    Scale X <small>(class="tran-x")</small>
  </div>
  <div class="p-3 m-1 bg-success text-white tran-y">
    Scale Y <small>(class="tran-y")</small>
  </div>
  <div class="p-3 m-1 bg-primary text-white tran-zoom">
    Zoom <small>(class="tran-zoom")</small>
  </div>
</div>

<button onclick='cb.transit(() => document.getElementById("demo").classList.toggle("d-none"))' class="my-1 btn btn-primary d-flex-inline">
  <i class="ico-sm icon-rocket"></i> Go!
</button>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>