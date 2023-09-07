var chat = {
  // (A) SETTINGS & FLAGS
  hMsg : null, hQn : null,
  hTxt : null, hGo : null,

  // (B) INIT
  init : () => {
    // (B1) GET HTML ELEMENTS
    chat.hMsg = document.getElementById("ai-chat");
    chat.hQn = document.getElementById("ai-query");
    chat.hTxt = document.getElementById("ai-txt");
    chat.hGo = document.getElementById("ai-go");

    // (B2) ENABLE CONTROLS
    chat.controls(1);
    chat.draw("Ready!", "system");
  },

  // (C) TOGGLE HTML CONTROLS
  controls : enable => {
    if (enable) {
      chat.hTxt.disabled = false;
      chat.hGo.disabled = false;
    } else {
      chat.hTxt.disabled = true;
      chat.hGo.disabled = true;
    }
  },

  // (D) SEND MESSAGE TO CHAT SERVER
  send : () => {
    // (D1) DATA TO SEND
    let data = new FormData();
    data.append("query", chat.hTxt.value);

    // (D2) UPDATE HTML INTERFACE
    chat.controls();
    chat.draw(chat.hTxt.value, "human");
    chat.hTxt.value = "";

    // (D3) FETCH
    fetch(AIEP, {
      method : "POST",
      mode : "cors",
      credentials : "include",
      body : data
    })
    .then(async res => {
      txt = await res.text();
      if (res.status == 200) { return txt; }
      else {
        console.error(txt);
        throw new Error("Bad server response");
      }
    })
    .then(res => chat.draw(res, "bot"))
    .catch(e => {
      chat.draw("ERROR - " + e.message, "system");
      console.error(e);
    })
    .finally(() => chat.controls(1));

    // (D4) PREVENT HTML FORM SUBMIT
    return false;
  },

  // (E) DRAW MESSAGE IN HTML
  draw : (msg, css) => {
    let row = document.createElement("div");
    row.className = "ai-" + css;
    row.innerHTML = `<img class="ai-ico" src="${cbhost.assets}ai-${css}.webp">
    <div class="ai-chatName">${css}</div>
    <div class="ai-chatMsg">${msg}</div>`;
    chat.hMsg.appendChild(row);
    row.classList.add("ai-show");
    chat.hMsg.scrollTop = chat.hMsg.scrollHeight;
  }
};
window.addEventListener("load", chat.init);