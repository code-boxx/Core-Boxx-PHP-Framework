var stars = {
  // (A) INIT - ATTACH HOVER & CLICK EVENTS
  init : () => {
    for (let widget of document.querySelectorAll(".stars")) {
      let all = widget.querySelectorAll("i.ico");
      for (let [i,star] of Object.entries(all)) {
        star.onmouseover = () => stars.hover(all, i);
        star.onclick = () => stars.save(widget.dataset.id, +i+1);
      }
    }
  },

  // (B) HOVER - UPDATE NUMBER OF YELLOW STARS
  hover : (all, rating) => {
    for (let [i,star] of Object.entries(all)) {
      if (i<=rating) {
        star.classList.remove("icon-star-empty");
        star.classList.add("icon-star-full");
        star.classList.add("text-danger");
      } else {
        star.classList.remove("icon-star-full");
        star.classList.remove("text-danger");
        star.classList.add("icon-star-empty");
      }
    }
  },

  // (C) UPDATE STAR RATING
  save : (id, rating) => cb.api({
    mod : "stars", act : "save",
    data : {
      id : id,
      stars : rating
    },
    passmsg : "Rating updated"
  })
  
};
window.addEventListener("load", stars.init);