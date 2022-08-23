<?php
$_PMETA = [
  "title" => "Core Boxx Demo Page",
  "desription" => "Optional Description"
];
require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h3>COMMON INTERFACE</h3>
<div class="mb-3">
  A quick walkthrough of the HTML and Javascript.
</div>

<!-- (A) PAGE LOAD SPINNER -->
<div class="bg-primary text-white p-3">
  <strong>Page Load Spinner</strong> -
  <ul>
    <li>Show - cb.loading(1)</li>
    <li>Hide - cb.loading(0)</li>
  </ul>
</div>
<div class="bg-white border p-3 mb-3">
  <button onclick="cb.loading(1)" class="btn btn-danger">Show</button>
</div>

<!-- (B) TOAST MESSAGE -->
<div class="bg-primary text-white p-3">
  <strong>Toast</strong> - cb.toast(STATUS, "TITLE", "MESSAGE")
</div>
<div class="bg-white border p-3 mb-3">
  <button onclick="cb.toast(2, 'TITLE', 'MESSAGE')" class="btn btn-danger">QUESTION Toast</button>
  <button onclick="cb.toast(1, 'TITLE', 'MESSAGE')" class="btn btn-danger">OK Toast</button>
  <button onclick="cb.toast(0, 'TITLE', 'MESSAGE')" class="btn btn-danger">FAIL Toast</button>
</div>

<!-- (C) MODAL DIALOG BOX -->
<div class="bg-primary text-white p-3">
  <strong>Modal</strong> - cb.modal("TITLE", "MESSAGE", "OPTIONAL FOOT")
</div>
<div class="bg-white border p-3 mb-3">
  <button onclick="cb.modal('TITLE', 'MESSAGE', 'OPTIONAL FOOT')" class="btn btn-danger">Modal A</button>
  <button onclick="cb.modal('TITLE', 'MESSAGE', ()=>{ alert('ok'); })" class="btn btn-danger">Modal B</button>
</div>

<!-- (D) API CALL -->
<div class="bg-primary text-white p-3">
  <strong>API Calls</strong>
</div>
<div class="bg-white border p-3 mb-3">
<pre>cb.api({
  mod : "MODULE",
  req : "REQUEST",
  data : { "KEY" : "VALUE" },
  loading : true/false,       // show loading spinner? default true.
  debug : true/false,         // debug mode? default false.
  passmsg : "Add successful", // toast message to show on success, false for none.
  nofail : true/false,        // supress "fetch failed" message? default false.
  onpass : FUNCTION,          // function to call on success, optional
  onfail : FUNCTION,          // function to call on failure, optional
  onerr : FUNCTION            // function to call on error, optional
})</pre>
</div>

<!-- (E) AJAX LOAD CONTENT -->
<div class="bg-primary text-white p-3">
  <strong>AJAX Load Content</strong>
</div>
<div class="bg-white border p-3 mb-3">
<pre>cb.load({
  page : "PAGE",              // http://site.com/PAGE/
  target : "cb-page-2",       // target html element to load content into
  data : { "KEY" : "VALUE" }, // data to send, if any.
  loading : true/false,       // show loading screen? default false.
  debug : true/false,         // debug mode? default false.
  onload : FUNCTION,          // do this on content load, optional.
  onerr : FUNCTION            // do this on ajax error, optional.
})</pre>
</div>

<!-- (F) PAGE CHANGE -->
<div class="bg-primary text-white p-3">
  <strong>Page</strong> - cb.page(1 TO 5).
  Use this to compliment cb.load().
</div>
<div class="bg-white border p-3 mb-3">
<pre>cb.load({
  page : "MYPAGE",
  target : "cb-page-2",
  data : { "KEY" : "VALUE" },
  onload : () => { cb.page(2); }
})</pre>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>