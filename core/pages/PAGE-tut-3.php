<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<div class="display-6 mb-4">VERY FAST TUTORIAL 3/6</div>

<div class="mb-1 fw-bold">
  Create a new library to work with the database.
  Add a new <code>lib/LIB-Items.php</code> file.
</div>
<pre class="mb-4 p-3 bg-dark text-white border"><code>class Items extends Core {
  // (A) GET ALL ITEMS
  function getAll () {
    return $this->DB->fetchKV(
      "SELECT * FROM `items`", null, "item_id", "item_name"
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

<div class="mb-1 fw-bold">How this works:</div>
<ol class="list-group list-group-numbered mb-4">
  <li class="list-group-item"><code>lib/LIB-Items.php</code> - Items, capital "I".</li>
  <li class="list-group-item"><code>class Items</code> - Same name, captial "I".</li>
  <li class="list-group-item"><code>extends Core</code> - Necessary.</li>
  <li class="list-group-item">
    We are pretty much just using <code>lib/LIB-DB.php</code> to build this library,
    which is the whole "modular and reusable" idea of Core Boxx.
    Example, if you want to use this Items library in the future:
    <pre class="mb-4 p-3 bg-dark text-white border"><code>class Foo extends Core {
  function bar () {
    $this->Core->load("Items");
    $items = $this->Items->getAll();
  }
}</code></pre>
  </li>
</ol>

<div class="mb-4">
  <a class="btn btn-danger" href="<?=HOST_BASE?>tut/2">Last Page</a>
  <a class="btn btn-primary" href="<?=HOST_BASE?>tut/4">Next Page</a>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>