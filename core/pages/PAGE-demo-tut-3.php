<h5 class="text-danger">CREATE NEW PHP LIBRARY</h5>
<div class="p-2 bg-dark text-white fw-bold">lib/LIB-Items.php</div>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>class Items extends Core {
  // (A) GET ALL ITEMS
  function getAll () {
    return $this->DB->fetchKV(
      "SELECT * FROM `items`", null,
      "item_id", "item_name"
    );
  }

  // (B) SAVE ITEM
  function save ($name, $id=null) : void {
    // (B1) DATA SETUP
    $fields = ["item_name"];
    $data = [$name];
    if ($id!=null) { $data[] = $id; }

    // (B2) INSERT OR UPDATE
    if ($id==null) { $this->DB->insert("items", $fields, $data); }
    else { $this->DB->update("items", $fields, "`item_id`=?", $data); }
  }

  // (C) DELETE ITEM
  function del ($id) : void {
    $this->DB->delete("items", "`item_id`=?", [$id]);
  }
}
</code></pre>

<div class="bg-white border p-4 mb-4"><ol class="mb-0">
  <li><code>lib/LIB-Items.php</code> - Items, capital "I".</li>
  <li><code>class Items</code> - Same name, captial "I".</li>
  <li><code>extends Core</code> - Necessary.</li>
  <li>We are pretty much just using <code>lib/LIB-DB.php</code> to build this library.</li>
</ol></div>

<h5 class="text-danger">REUSABLE MODULES</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>class Foo extends Core {
  function bar () {
    $this->Core->load("Items");
    $items = $this->Items->getAll();
  }
}</code></pre>

<div class="bg-white border p-4 mb-4">
  Core Boxx is a <strong>modular and reusable</strong> engine.
  We can create another library in the future, and reuse the <code>Items</code> library entirely.
</div>

<div class="mb-4">
  <button class="my-1 btn btn-primary d-flex-inline" onclick="tut(2)">
    <i class="ico-sm icon-arrow-left me-2"></i> Last Page
  </button>
  <button class="my-1 btn btn-primary d-flex-inline" onclick="tut(4)">
    Next Page <i class="ico-sm icon-arrow-right ms-2"></i>
  </button>
</div>