<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-0">HTML INTERFACE DEMO</h1>
<div class="text-secondary mb-4">a quick walkthrough of the common html js</div>

<!-- (A) PAGE LOAD SPINNER -->
<h5 class="text-danger">PAGE LOAD SPINNER</h5>
<div class="bg-white border p-4 mb-4">
  <ul>
    <li>Show - <code>cb.loading(1)</code></li>
    <li>Hide - <code>cb.loading(0)</code></li>
  </ul>
  <button onclick="cb.loading(1); setTimeout(()=>cb.loading(0), 3000);" class="m-1 btn btn-primary">Show Loading For 3 Seconds</button>
</div>

<!-- (B) TOAST MESSAGE -->
<h5 class="text-danger">TOAST MESSAGE</h5>
<div class="bg-white border p-4 mb-4">
  <ul>
    <li><code>cb.toast(STATUS, "TITLE", "MESSAGE")</code></li>
    <li>Status <code>2</code> - Question</li>
    <li>Status <code>1</code> - OK</li>
    <li>Status <code>0</code> - Fail</li>
  </ul>
  <button onclick="cb.toast(2, 'TITLE', 'MESSAGE')" class="m-1 btn btn-primary">QUESTION Toast</button>
  <button onclick="cb.toast(1, 'TITLE', 'MESSAGE')" class="m-1 btn btn-primary">OK Toast</button>
  <button onclick="cb.toast(0, 'TITLE', 'MESSAGE')" class="m-1 btn btn-primary">FAIL Toast</button>
</div>

<!-- (C) MODAL DIALOG BOX -->
<h5 class="text-danger">MODAL DIALOG BOX</h5>
<div class="bg-white border p-4 mb-4">
  <ul>
    <li>Basic - <code>cb.modal("TITLE", "MESSAGE")</code></li>
    <li>Run function on clicking "OK" - <code>cb.modal("TITLE", "MESSAGE", FUNCTION)</code></li>
    <li>Define your own footer - <code>cb.modal("TITLE", "MESSAGE", "MY FOOTER")</code></li>
  </ul>
  <button onclick="cb.modal('TITLE', 'MESSAGE')" class="m-1 btn btn-primary">Modal - No Footer</button>
  <button onclick="cb.modal('TITLE', 'MESSAGE', ()=>{ alert('ok'); })" class="m-1 btn btn-primary">Modal - Custom OK Function</button>
  <button onclick="cb.modal('TITLE', 'MESSAGE', 'MY FOOTER')" class="m-1 btn btn-primary">Modal - Custom Footer</button>
</div>

<!-- (D) API CALL -->
<h5 class="text-danger">API CALL</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-4"><code>cb.api({
  mod : "MODULE",
  act : "ACTION",
  data : { "KEY" : "VALUE" },
  loading : true/false,       // show loading spinner? default true.
  debug : true/false,         // debug mode? default false.
  passmsg : "Add successful", // toast message to show on success, false for none.
  nofail : true/false,        // supress "fetch failed" message? default false.
  onpass : FUNCTION,          // function to call on success, optional
  onfail : FUNCTION,          // function to call on failure, optional
  onerr : FUNCTION            // function to call on error, optional
})</code></pre>

<!-- (E) AJAX LOAD CONTENT -->
<h5 class="text-danger">AJAX LOAD CONTENT</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-4"><code>cb.load({
  page : "PAGE",              // http://site.com/PAGE/
  target : "ID",              // target html element to load content into
  data : { "KEY" : "VALUE" }, // data to send, if any.
  loading : true/false,       // show loading screen? default false.
  debug : true/false,         // debug mode? default false.
  onload : FUNCTION,          // do this on content load, optional.
  onerr : FUNCTION            // do this on ajax error, optional.
})</code></pre>

<!-- (F) PAGE CHANGE -->
<h5 class="text-danger">PAGES</h5>
<script>
function demo () {
  cb.hPages[1].innerHTML =
  `<h3>THIS IS CB-PAGE-2</h3>
    <div class="my-3">Right click - Inspect element.</div>
    <button onclick="cb.page(1)" class="m-1 btn btn-primary">Back</button>`;
  cb.page(2);
}
</script>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>cb.load({
  page : "MYPAGE",
  target : "cb-page-2",
  onload : () => cb.page(2)
})</code></pre>
<div class="bg-white border p-4 mb-4">
  <ul>
    <li>There are 5 <code>&lt;div id="cb-page-N"&gt;</code> in this template to facilitate a single page app (as much as possible).</li>
    <li>Use <code>cb.page(1 TO 5)</code> to switch between <code>&lt;div id="cb-page-N"&gt;</code></li>
  </ul>
  <button onclick="demo()" class="m-1 btn btn-primary">Switch To cb-page-2</button>
</div>

<!-- (G) URL -->
<h5 class="text-danger">URL</h5>
<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li><code>cbhost.base</code> - Base URL <code><?=HOST_BASE?></code></li>
    <li><code>cbhost.api</code> - API URL <code><?=HOST_API_BASE?></code></li>
    <li><code>cbhost.assets</code> - Assets URL <code><?=HOST_ASSETS?></code></li>
  </ul>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>