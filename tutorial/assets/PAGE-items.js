// (A) HELPER - CALL API
function ajax (mod, act, data, after) {
  // (A1) FORM DATA
  let form = new FormData();
  if (data) {
    for (let [k,v] of Object.entries(data)) { form.append(k, v); }
  }

  // (A2) AJAX FETCH
  fetch(`${cbhost.api}${mod}/${act}`, { method:"POST", body:form })
  .then(res => res.json())
  .then(res => {
    if (res.status) { after(res.data); }
    else { alert(res.message); }
  })
  .catch(err => console.error(err));
}

// (B) GET ALL - DRAW HTML LIST
function list () {
  ajax("items", "getAll", null, data => { if (data != null) {
    let wrap = document.getElementById("iList");
    wrap.innerHTML = "";
    for (let [i,n] of Object.entries(data)) {
      let row = document.createElement("li");
      row.className = "list-item";
      row.innerHTML = `<form class="d-flex mb-2" onsubmit="return update(${i});">
        <input type="button" class="btn btn-danger me-1" value="Del" onclick="del(${i})">
        <input class="form-control me-1" type="text" id="iItem${i}" value="${n}" required>
        <input class="btn btn-primary" type="submit" value="Save">
      </form>`;
      wrap.appendChild(row);
    }
  }});
}

// (C) ADD ITEM
function add () {
  ajax("items", "save", { name: document.getElementById("iAdd").value }, list);
  return false;
}

// (D) UPDATE ITEM
function update (id) {
  ajax("items", "save", { name: document.getElementById("iItem"+id).value, id: id }, list);
  return false;
}

// (C) DELETE ITEM
function del (id) {
  ajax("items", "del", { id: id }, list);
}
window.addEventListener("load", list);