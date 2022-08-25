var comment = {
  // (A) PROPERTIES
  id : 999, // "content id" fixed to 999 for this demo

  // (B) SHOW COMMENTS
  show : () => {
    cb.api({
      mod : "comments", req : "getAll",
      data : { id : comment.id },
      passmsg : false,
      onpass : res => {
        // @TODO
        console.log(res);
        var cwrap = document.getElementById("cwrap");
        cwrap.innerHTML = "";
        if (res.data!=null) { for (let cid in res.data) {
          let row = document.createElement("div");
          row.className = "p-2 mb-2 border bg-white";
          row.innerHTML = res.data[cid]["message"];
          cwrap.appendChild(row);
        }} else { cwrap.innerHTML = "No comments"; }
      }
    });
  },

  // (C) ADD COMMENT
  add : () => {
    cb.api({
      mod : "comments", req : "save", data : {
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