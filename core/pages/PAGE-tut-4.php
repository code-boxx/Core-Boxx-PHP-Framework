<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="display-6 mb-4">VERY FAST TUTORIAL 4/6</div>

<div class="mb-1 fw-bold">
  Create API endpoint. Add a new <code>lib/API-items.php</code> file.
</div>
<pre class="mb-4 p-3 bg-dark text-white border"><code>// (A) API ENDPOINTS
$_CORE->autoAPI([
  "getAll" => ["Items", "getAll"],
  "save" => ["Items", "save"],
  "del" => ["Items", "del"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);
</code></pre>

<div class="mb-1 fw-bold">How this works:</div>
<ol class="list-group list-group-numbered mb-4">
  <li class="list-group-item">API endpoints have the format of <code>http://site.com/api/MODULE/ACTION</code></li>
  <li class="list-group-item">Example, access <code>http://site.com/api/items/getAll</code> to get all the items.</li>
  <li class="list-group-item">Example, send <code>$_POST["name"]="ITEM"</code> to <code>http://site.com/api/items/save</code> to create a new item.</li>
  <li class="list-group-item">You should have figured this now - Create <code>API-foo.php</code> and it will be accessible at <code>http://site.com/api/foo/ACTION</code></li>
  <li class="list-group-item"><code>$_CORE->autoAPI()</code> automatically maps <code>ACTION => ["MODULE", "FUNCTION"]</code>.</li>
</ol>

<div class="mb-4">
  <a class="btn btn-danger" href="<?=HOST_BASE?>tut/3">Last Page</a>
  <a class="btn btn-primary" href="<?=HOST_BASE?>tut/5">Next Page</a>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>