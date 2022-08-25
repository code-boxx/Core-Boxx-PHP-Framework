function lidi (inst) {
//  hWrap : html like/dislike container
//  change : function to handle like/dislike toggle change
//  status : -1 dislike, 0 neutral, 1 like (optional, default 0)
//  count : [likes, dislikes] (optional)

  // (A) DEFAULT STATUS + CSS WRAPPER CLASS
  if (!inst.status) { inst.status = 0; }
  inst.hWrap.classList.add("lidiWrap");

  // (B) ATTACH LIKE & DISLIKE BUTTON
  inst.hUp = document.createElement("div");
  inst.hDown = document.createElement("div");
  inst.hUp.className = "lidiUp";
  inst.hDown.className = "lidiDown";
  if (inst.status==1) { inst.hUp.classList.add("set"); }
  if (inst.status==-1) { inst.hDown.classList.add("set"); }
  inst.hWrap.appendChild(inst.hUp);
  inst.hWrap.appendChild(inst.hDown);

  // (C) ATTACH LIKE & DISLIKE COUNT
  if (inst.count) {
    // (C1) LIKE & DISLIKE COUNT HTML
    inst.hUpCount = document.createElement("div");
    inst.hDownCount = document.createElement("div");
    inst.hUpCount.className = "lidiUpCount";
    inst.hDownCount.className = "lidiDownCount";
    inst.hUpCount.innerHTML = inst.count[0];
    inst.hDownCount.innerHTML = inst.count[1];
    inst.hWrap.classList.add("count");
    inst.hWrap.insertBefore(inst.hUpCount, inst.hDown);
    inst.hWrap.insertBefore(inst.hDownCount, inst.hDown.nextSibling);

    // (C2) UPDATE LIKE & DISLIKE COUNT
    inst.recount = count => {
      inst.count = count;
      inst.hUpCount.innerHTML = count[0];
      inst.hDownCount.innerHTML = count[1];
    };
  }

  // (D) TOGGLE LIKE/DISLIKE
  inst.updown = up => {
    // (D1) UPDATE STATUS FLAG
    if (up) { inst.status = inst.status == 1 ? 0 : 1; }
    else { inst.status = inst.status == -1 ? 0 : -1; }

    // (D2) UPDATE LIKE/DISLIKE CSS
    if (inst.status==1) {
      inst.hUp.classList.add("set");
      inst.hDown.classList.remove("set");
    } else if (inst.status==-1) {
      inst.hUp.classList.remove("set");
      inst.hDown.classList.add("set");
    } else {
      inst.hUp.classList.remove("set");
      inst.hDown.classList.remove("set");
    }

    // (D3) TRIGGER CHANGE
    inst.change(inst.status);
  };
  inst.hUp.onclick = () => { inst.updown(true); };
  inst.hDown.onclick = () => { inst.updown(false); };

  // (E) DONE
  return inst;
}