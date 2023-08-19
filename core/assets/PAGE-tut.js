var tut = pg => cb.load({
  page : "demo/tut/" + pg,
  target : "tut",
  onload : () => {
    let pb = document.getElementById("pb");
    pb.innerHTML = `${pg} of 6`;
    pb.style.width = Math.floor(pg / 6 * 100) + "%";
  }
});
window.addEventListener("load", () => tut(1));