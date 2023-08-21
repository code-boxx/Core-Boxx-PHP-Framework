function reaction (rid) {
  cb.api({
    mod : "reactions", act : "save",
    data : {
      id : document.getElementById("pid").value,
      reaction : document.querySelector(`#reaction${rid} .set`) ? 0 : rid,
      get : 1
    },
    passmsg : false,
    onpass : res => {
      for (let r of document.querySelectorAll("#reactions .reaction")) {
        r.querySelector(".count").innerHTML = res.data["react"][r.dataset.rid] ? res.data["react"][r.dataset.rid] : 0;
        if (parseInt(res.data["user"]) == parseInt(r.dataset.rid)) {
          r.querySelector(".ico").classList.add("set");
        } else {
          r.querySelector(".ico").classList.remove("set");
        }
      }
    }
  });
}