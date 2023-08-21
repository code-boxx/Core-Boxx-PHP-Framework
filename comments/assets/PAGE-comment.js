var comment = {
  // (A) PROPERTIES
  id : 999, // "content id" fixed to 999 for this demo

  // (B) SHOW COMMENTS
  show : () => cb.api({
    mod : "comments", act : "getAll",
    data : { id : comment.id },
    passmsg : false,
    onpass : res => {
      var cwrap = document.getElementById("cwrap");
      cwrap.innerHTML = "";
      if (res.data!=null) { for (let cid in res.data) {
        let row = document.createElement("div");
        row.className = "p-3 mb-2 border bg-white";
        row.innerHTML = `<div class="fw-bold text-danger">${res.data[cid]["user_name"]}</div>
        <div>${res.data[cid]["message"]}</div>
        <small class="text-secondary">${res.data[cid]["timestamp"]}</small>`;
        cwrap.appendChild(row);
      }} else { cwrap.innerHTML = "No comments"; }
    }
  }),

  // (C) ADD COMMENT
  add : () => {
    cb.api({
      mod : "comments", act : "save", data : {
        id : comment.id,
        message : document.getElementById("cmsg").value
      },
      passmsg : false,
      onpass : res => {
        document.getElementById("cmsg").value = "";
        comment.show();
      }
    });
    return false;
  }
};
window.addEventListener("load", comment.show);