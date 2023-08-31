<?php
// (A) PAGE META
$_PMETA = [
  "load" => [
    ["s", HOST_ASSETS . "CB-autocomplete.js"]
  ]
];

// (B) HTML PAGE
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-4">AUTOCOMPLETE DEMO</h1>

<!-- (B1) DUMMY FIELDS -->
<div class="form-floating mb-4">
  <input type="text" id="dummyA" class="form-control">
  <label>Name</label>
  <div class="text-secondary mt-1">
    ["Abby", "Abel", "Joe", "Jon", "Joy", "Yoda", "York"]
  </div>
</div>

<label>Item</label>
<input type="text" id="dummyB" class="form-control">
<div class="text-secondary mt-1">
    ["SKU1" : "Apple",
     "SKU2" : "Appor",
     "SKU3" : "Grape",
     "SKU4" : "Grabe",
     "SKU5" : "Watermelon",
     "SKU6" : "Water"]
</div>

<!-- (B2) ATTACH AUTOCOMPLETE -->
<script>
window.addEventListener("load", () => {
  // (B2-1) MINIMUM AUTOCOMPLETE
  autocomplete.attach({
    target : document.getElementById("dummyA"),
    mod : "autocomplete", act : "user"
  });

  // (B2-2) WITH OPTIONS
  autocomplete.attach({
    // REQUIRED
    target : document.getElementById("dummyB"),
    mod : "autocomplete", act : "item",

    // OPTIONAL
    data : {
      aaa : "fixed value",
      bbb : document.getElementById("dummyA")
    },
    onpick : picked => { console.log(picked); }
  });
});
</script>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>