<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) JS -->
<script>
// (A1) "CONTENT ID" FIXED TO 999 FOR THIS DEMO
var id = 999;

// (A2) GET ALL COMMENTS
function getAll () {
  var data = new FormData();
  data.append("id", id);
  fetch("<?=HOST_API_BASE?>comments/getAll", { method:"post", body:data })
  .then(res => res.json()).then((res) => {
    var cwrap = document.getElementById("cwrap");
    if (res.data!=null) {
      cwrap.innerHTML = "";
      for (let cid in res.data) {
        let row = document.createElement("div");
        row.innerHTML = res.data[cid]["message"];
        cwrap.appendChild(row);
      }
    } else {
      cwrap.innerHTML = "No comments";
    }
  });
}
window.addEventListener("load", getAll);

// (A2) ADD COMMENT
function comment () {
  var data = new FormData(document.getElementById("cform"));
  data.append("id", id);
  fetch("<?=HOST_API_BASE?>comments/save", { method:"post", body:data })
  .then(res => res.json()).then((res) => {
    if (res.status) { getAll(); }
    else { alert(res.message); }
  });
  return false;
}
</script>

<!-- (B) COMMENTS -->
<div id="cwrap"></div>

<!-- (C) ADD COMMENT -->
<form id="cform" onsubmit="return comment()">
  <textarea name="message" required></textarea>
  <input type="submit" value="Comment"/>
</form>


<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
