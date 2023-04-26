<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<h1 class="mb-4">VERY FAST TUTORIAL 5/6</h1>

<div class="mb-1 fw-bold">
  You can build your web and/or mobile app by solely working with the API.
</div>
<pre class="mb-4 p-3 bg-dark text-white border"><code>// (A) HELPER - CALL API
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

<div class="mb-4">
  <a class="btn btn-danger" href="<?=HOST_BASE?>tut/4">Last Page</a>
  <a class="btn btn-primary" href="<?=HOST_BASE?>tut/6">Next Page</a>
</div>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>