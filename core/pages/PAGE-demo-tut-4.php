<h5 class="text-danger">CREATE API ENDPOINT</h5>
<div class="p-2 bg-dark text-white fw-bold">lib/API-items.php</div>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>// (A) API ENDPOINTS
$_CORE->autoAPI([
  "getAll" => ["Items", "getAll"],
  "save" => ["Items", "save"],
  "del" => ["Items", "del"]
]);

// (B) INVALID REQUEST
$_CORE->respond(0, "Invalid request", null, null, 400);
</code></pre>

<div class="bg-white border p-4 mb-4"><ol class="mb-0">
  <li>API endpoints have the format of <code>http://site.com/api/MODULE/ACTION</code></li>
  <li>Example, access <code>http://site.com/api/items/getAll</code> to get all the items.</li>
  <li>Example, send <code>$_POST["name"]="ITEM"</code> to <code>http://site.com/api/items/save</code> to create a new item.</li>
  <li>You should have figured this now - Create <code>API-foo.php</code> and it will be accessible at <code>http://site.com/api/foo/ACTION</code></li>
  <li><code>$_CORE->autoAPI()</code> automatically maps <code>ACTION => ["MODULE", "FUNCTION"]</code>.</li>
</ol></div>

<div class="mb-4 d-flex">
  <button class="btn btn-danger w-50 mx-1 d-flex align-items-center justify-content-center" onclick="tut(3)">
    <i class="ico-sm icon-arrow-left me-2"></i> Last Page
  </button>
  <button class="btn btn-primary w-50 mx-1 d-flex align-items-center justify-content-center" onclick="tut(5)">
    Next Page <i class="ico-sm icon-arrow-right ms-2"></i>
  </button>
</div>