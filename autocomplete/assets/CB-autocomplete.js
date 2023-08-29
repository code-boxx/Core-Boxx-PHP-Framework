var autocomplete = {
  // (A) SETTINGS & PROPERTIES
  min : 2,       // minimum 2 characters to trigger suggestions
  delay : 500,   // delay before suggestion in ms
  active : null, // current active suggestion box

  // (B) ATTACH AUTOCOMPLETE
  //  target : target html field
  //  mod : api module
  //  act : api action
  //  onpick : callback function, optional
  attach : i => {
    // (B1) CREATE SUGGESTION BOX + NATIVE AUTOCOMPLETE OFF
    i.suggest = document.createElement("ul");
    i.suggest.className = "list-group position-absolute z-2 d-none";
    i.target.setAttribute("autocomplete", "off");

    // (B2) FLOATING FORM - DIRECT INSERT SUGGESTION BOX
    if (i.target.parentElement.classList.contains("form-floating")) {
      i.wrapper = i.target.parentElement;
      i.wrapper.appendChild(i.suggest);
    }

    // (B3) "NORMAL FIELD"
    else {
      i.wrapper = document.createElement("div");
      i.wrapper.style.display = window.getComputedStyle(i.target).getPropertyValue("display");
      i.wrapper.style.position = "relative";
      i.target.parentElement.insertBefore(i.wrapper, i.target);
      i.wrapper.appendChild(i.target);
      i.wrapper.appendChild(i.suggest);
    }

    // (B4) INSTANCE PROPERTIES
    i.timer = null;
    if (i.data==undefined) { i.data = {}; }

    // (B5) CLOSE THIS SUGGESTION BOX
    i.close = () => {
      window.clearTimeout(i.timer);
      i.suggest.innerHTML = "";
      i.suggest.classList.add("d-none");
    };

    // (B6) FETCH DATA FROM API
    i.fetch = () => {
      // (B6-1) CLEAR PREVIOUS TIMER
      window.clearTimeout(i.timer);

      // (B6-2) POST DATA
      let data = i.data;
      data.search = i.target.value;

      // (B6-3) API CALL
      cb.api({
        mod : i.mod, act : i.act, data : data,
        loading : false, passmsg : false,
        onpass : res => {
          // (B6-4) NO RESULTS
          if (res.data==null) { i.close(); }

          // (B6-5) DRAW RESULTS & SET "CURRENTLY ACTIVE"
          else {
            i.suggest.innerHTML = "";
            for (let r of res.data) {
              let row = document.createElement("li");
              row.className = "list-group-item";
              row.innerHTML = r.n;
              row.onclick = () => {
                i.target.value = r.v ? r.v : r.n ;
                i.close();
                if (i.onpick) { i.onpick(r); }
              };
              i.suggest.appendChild(row);
            }
            i.suggest.classList.remove("d-none");
            autocomplete.active = i;
          }
        }
      });
    };

    // (B7) LISTEN TO KEY PRESS
    i.target.addEventListener("keyup", evt => {
      // (B7-1) CLEAR OLD TIMER & SUGGESTION BOX
      i.close();

      // (B7-2) CREATE NEW TIMER - FETCH DATA FROM SERVER
      if (i.target.value.length >= autocomplete.min) {
        i.timer = setTimeout(i.fetch, autocomplete.delay);
      }
    });
  },

  // (C) AUTOCLOSE SUGGESTION BOX ON CLICK ELSEWHERE
  checkclose : evt => { if (autocomplete.active != null) {
    if (i.wrapper.contains(evt.target)==false &&
        i.field.contains(evt.target)==false) {
      i.close();
      autocomplete.active = null;
    }
  }}
};