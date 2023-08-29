<?php
// (A) PAGE META
$_PMETA = [
  "load" => [
    ["s", HOST_ASSETS . "CB-autocomplete.js"]
  ]
];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (B1) DUMMY FIELDS -->
<div class="form-floating mb-4">
  <input type="text" id="dummyA" class="form-control">
  <label>Name</label>
</div>

<label>Item</label>
<input type="text" id="dummyB" class="form-control">

<!-- (B2) ATTACH AUTOCOMPLETE -->
<script>
window.addEventListener("load", () => {
  // (B2-1) MINIMUM AUTOCOMPLETE
  autocomplete.attach({
    target : document.getElementById("dummyA"),
    mod : "autocomplete", act : "user"
  });

  // (B2-2) CALLBACK ON PICK
  autocomplete.attach({
    target : document.getElementById("dummyB"),
    mod : "autocomplete", act : "item",
    onpick : picked => {
      console.log(picked);
    }
  });
});
</script>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>