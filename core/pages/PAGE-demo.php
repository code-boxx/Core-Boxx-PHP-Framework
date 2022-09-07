<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
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
  <button onclick="cb.loading(1); setTimeout(()=>{cb.loading(0);}, 3000);" class="btn btn-danger">Show Loading For 3 Seconds</button>
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
  target : "ID",              // target html element to load content into
  data : { "KEY" : "VALUE" }, // data to send, if any.
  loading : true/false,       // show loading screen? default false.
  debug : true/false,         // debug mode? default false.
  onload : FUNCTION,          // do this on content load, optional.
  onerr : FUNCTION            // do this on ajax error, optional.
})</pre>
</div>

<!-- (F) PAGE CHANGE -->
<script>
function demo () {
  cb.hPages[1].innerHTML =
  `<h3>THIS IS CB-PAGE-2</h3>
    <div class="my-3">Right click - Inspect element.</div>
    <button onclick="cb.page(0)" class="btn btn-danger">Back</button>`;
  cb.page(1)
}
</script>
<div class="bg-primary text-white p-3">
  <strong>Page</strong>
  <ul>
    <li>There are 5 &lt;div id="cb-page-N"&gt; in this template to facilitate a single page app (as much as possible).</li>
    <li>Use cb.page(0 TO 4) to switch between &lt;div id="cb-page-N"&gt;</li>
  </ul>
</div>
<div class="bg-white border p-3 mb-3">
<pre>cb.load({
  page : "MYPAGE",
  target : "cb-page-2",
  onload : () => { cb.page(1); } // 0 is cb-page-1
})</pre>
<button onclick="demo()" class="btn btn-danger">Demo</button>
</div>

<!-- (G) URL -->
<div class="bg-primary text-white p-3">
  <strong>URL</strong>
</div>
<div class="bg-white border p-3 mb-3">
  <ul>
    <li><strong>cbhost.base</strong> - Base URL <?=HOST_BASE?></li>
    <li><strong>cbhost.api</strong> - API URL <?=HOST_API_BASE?></li>
    <li><strong>cbhost.assets</strong> - Assets URL <?=HOST_ASSETS?></li>
  </ul>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>