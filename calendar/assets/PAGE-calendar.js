var cal = {
  // (A) PROPERTIES
  events : null, // events data for current month/year
  hMth : null, hYear : null, // html month & year
  hWrap : null, // html calendar wrapper
  // html form & fields
  hFormWrap : null, hForm : null, hfID : null, 
  hfStart : null, hfEnd : null, hfTxt : null,
  hfColor : null, hfBG : null, hfDel : null,

  // (B) INIT CALENDAR
  init : () => {
    // (B1) GET HTML ELEMENTS
    cal.hMth = document.getElementById("calMonth");
    cal.hYear = document.getElementById("calYear");
    cal.hWrap = document.getElementById("calWrap");
    cal.hFormWrap = document.getElementById("calForm");
    cal.hForm = cal.hFormWrap.querySelector("form");
    cal.hfID = document.getElementById("evtID");
    cal.hfStart = document.getElementById("evtStart");
    cal.hfEnd = document.getElementById("evtEnd");
    cal.hfTxt = document.getElementById("evtTxt");
    cal.hfColor = document.getElementById("evtColor");
    cal.hfBG = document.getElementById("evtBG");
    cal.hfDel = document.getElementById("evtDel");

    // (B2) ATTACH CONTROLS
    cal.hMth.onchange = cal.draw;
    cal.hYear.onchange = cal.draw;
    document.getElementById("calAdd").onclick = () => { cal.show(); };
    cal.hForm.onsubmit = () => { return cal.save(); };
    document.getElementById("evtCX").onclick = () => { cal.hFormWrap.classList.remove("show"); };
    cal.hfDel.onclick = cal.del;

    // (B3) DRAW CALENDAR
    cal.draw();
  },

  // (C) DRAW CALENDAR
  draw : () => {
    // (C1) FETCH DATA
    cb.api({
      mod : "calendar", req : "getPeriod",
      data : { month : cal.hMth.value, year : cal.hYear.value },
      passmsg : false,
      onpass : res => {
        // (C2) "UNPACK DATA"
        cal.events = res.data.e;
        let wrap, row, cell, evt, i = 0,
        days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        if (res.s) { days.unshift("Sun"); }
        else { days.push("Sun"); }

        // (C3) "RESET" CALENDAR
        cal.hWrap.innerHTML = `<div class="calHead"></div>
          <div class="calBody">
          <div class="calRow"></div>
        </div>`;

        // (C4) CALENDAR HEADER - DAY NAMES
        wrap = cal.hWrap.querySelector(".calHead");
        for (let d of days) {
          cell = document.createElement("div");
          cell.className = "calCell";
          cell.innerHTML = d;
          wrap.appendChild(cell);
        }

        // (C5) CALENDAR BODY - INDIVIDUAL DAYS & EVENTS
        wrap = cal.hWrap.querySelector(".calBody");
        row = cal.hWrap.querySelector(".calRow");
        for (let c of res.data.c) {
          // (C5-1) GENERATE CELL
          cell = document.createElement("div");
          cell.className = "calCell";
          if (c.t) { cell.classList.add("calToday"); }
          if (c.b) { cell.classList.add("calBlank"); }
          else {
            cell.innerHTML = `<div class="cellDate">${c.d}</div>
            <div class="cellEvt"></div>`;
          }
          row.appendChild(cell);

          if (c.e) {
            cell = cell.querySelector(".cellEvt");
            for (let id of c.e) {
              evt = document.createElement("div");
              evt.className = "evt";
              evt.style.color = cal.events[id]["c"];
              evt.style.background = cal.events[id]["b"];
              evt.innerHTML = cal.events[id]["t"];
              evt.onclick = () => { cal.show(id); };
              cell.appendChild(evt);
            }
          }

          // (C5-2) NEW ROW
          i++;
          if (i%7==0 && i!=res.data.c.length) {
            row = document.createElement("div");
            row.className = "calRow";
            wrap.appendChild(row);
          }
        }
      }
    });
  },

  // (D) SHOW EVENT FORM
  show : id => {
    if (id) {
      cal.hfID.value = id;
      cal.hfStart.value = cal.events[id]["s"].replace(" ", "T").substring(0, 16);
      cal.hfEnd.value = cal.events[id]["e"].replace(" ", "T").substring(0, 16);
      cal.hfTxt.value = cal.events[id]["t"];
      cal.hfColor.value = cal.events[id]["c"];
      cal.hfBG.value = cal.events[id]["b"];
      cal.hfDel.style.display = "block";
    } else {
      cal.hForm.reset();
      cal.hfID.value = "";
      cal.hfDel.style.display = "none";
    }
    cal.hFormWrap.classList.add("show");
  },

  // (E) SAVE EVENT
  save : () => {
    // (E1) COLLECT DATA
    var data = {
      start : cal.hfStart.value,
      end : cal.hfEnd.value,
      txt : cal.hfTxt.value,
      color : cal.hfColor.value,
      bg : cal.hfBG.value
    };
    if (cal.hfID.value != "") { data.id = cal.hfID.value; }

    // (E2) DATE CHECK
    if (new Date(data.start) > new Date(data.end)) {
      cb.modal("Error", "Start date cannot be later than end date!");
      return false;
    }

    // (E3) AJAX SAVE
    cb.api({
      mod : "calendar", req : "save", data : data,
      passmsg : "Event saved",
      onpass : res => {
        cal.hFormWrap.classList.remove("show");
        cal.draw();
      }
    });
    return false;
  },

  // (F) DELETE EVENT
  del : () => {
    cb.modal("Please Confirm", "Delete Event?", () => {
      cb.api({
        mod : "calendar", req : "del",
        data : { id : cal.hfID.value },
        passmsg : "Event deleted",
        onpass : res => {
          cal.hFormWrap.classList.remove("show");
          cal.draw();
        }
      });
    });
  }
};
window.addEventListener("load", cal.init);