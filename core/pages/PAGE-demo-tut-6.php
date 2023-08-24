<h5 class="text-danger">JAVASCRIPT ONLY</h5>
<pre style="background:#2a3d6a" class="text-white border p-4 mb-2"><code>// (A) HELPER - CALL API
function ajax (mod, act, data, after) {
  // (A1) FORM DATA
  let form = new FormData();
  if (data) {
    for (let [k,v] of Object.entries(data)) { form.append(k, v); }
  } 

  // (A2) AJAX FETCH
  fetch(`http://site.com/api/${mod}/${act}`, { method:"POST", body:form })
  .then(res => res.json())
  .then(res => {
    if (res.status) { after(res.data); }
    else { alert(res.message); }
  })
  .catch(err => console.error(err));
}

// (B) ADD/UPDATE ITEM
ajax("items", "save", { name: "Test" }, () => alert("OK"));
ajax("items", "save", { name: "Testzzz", id: 1 }, () => alert("OK"));

// (C) DELETE ITEM
ajax("items", "del", { id: 123 }, () => alert("OK"));

// (D) GET ALL
ajax("items", "getAll", null, data => {
  for (let [i,n] of Object.entries(data)) { BUILD HTML LIST }
});
</code></pre>

<div class="bg-white border p-4 mb-4">
  <ul class="mb-0">
    <li>Which platform really doesn't quite matter...</li>
    <li>You can also build your web and/or mobile app by solely working with the API.</li>
    <li>The end!</li>
  </ul>
</div>

<div class="mb-4">
  <button class="my-1 btn btn-primary d-flex-inline" onclick="tut(5)">
    <i class="ico-sm icon-arrow-left me-2"></i> Last Page
  </button>
  <button class="my-1 btn btn-primary d-flex-inline" onclick="tut(1)">
    <i class="ico-sm icon-undo me-2"></i> Restart
  </button>
</div>