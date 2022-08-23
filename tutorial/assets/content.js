var content = {
  // (A) FETCH & LIST CONTENT
  list : () => {
    // (A1) GET & RESET HTML LIST WRAPPER
    let cList = document.getElementById("cList");
    cList.innerHTML = "";

    // (A2) FETCH & DRAW CONTENT ROWS
    cb.api({
      mod : "content", req : "getAll", passmsg : false,
      onpass : res => {
        if (res.data != null) { for (let c of res.data) {
          let row = document.createElement("li");
          row.id = "content" + c.id;
          row.className = "list-group-item";
          row.innerHTML = c.content;
          row.onclick = () => { content.addedit(c.id); };
          cList.appendChild(row);
        }}
      }
    });
  },

  // (B) GENERATE & SHOW ADD/EDIT CONTENT SCREEEN
  //  id : content id, none for new
  addedit : id => {
    // (B1) BUILD HTML
    let txt = id ? document.getElementById("content"+id).innerHTML : "";
    cb.hPages[1].innerHTML = 
    `<form onsubmit="return content.save()">
        <input type="hidden" readonly id="cid" value="${id?id:""}">
        <textarea class="form-control" id="ctxt" required>${txt}</textarea>
        <div class="mt-3">
          <input type="button" class="btn btn-danger" value="Back" onclick="cb.page(0)">
          <input type="submit" class="btn btn-primary" value="Save">
        </div>
     </form>`;

    // (B2) SWITCH PAGE SECTION
    cb.page(1);
  },

  // (C) SAVE CONTENT
  save : () => {
    // (C1) GET FORM DATA
    let data = {
      content : document.getElementById("ctxt").value,
      id : document.getElementById("cid").value
    };
    if (data.id=="") { delete data.id; }

    // (C2) API SAVE
    cb.api({
      mod : "content", req : "save", data : data,
      onpass : () => {
        cb.page(0);
        content.list();
      }
    });
    return false;
  }
};
window.addEventListener("load", content.list);