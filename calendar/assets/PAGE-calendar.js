var cal = {
  // (A) PROPERTIES
  mon : false, // monday first
  events : null, // events data for current month/year
  hMth : null, hYear : null, // html month & year
  hCD : null, hCB : null, // html calendar days & body
  // html form & fields
  hFormWrap : null, hForm : null, hfID : null, 
  hfStart : null, hfEnd : null, hfTxt : null,
  hfColor : null, hfBG : null, hfDel : null,

  // (B) INIT CALENDAR
  init : () => {
    // (B1) GET HTML ELEMENTS
    cal.hMth = document.getElementById("calMonth");
    cal.hYear = document.getElementById("calYear");
    cal.hCD = document.getElementById("calDays");
    cal.hCB = document.getElementById("calBody");
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
    document.getElementById("calAdd").onclick = () => cal.show();
    cal.hForm.onsubmit = () => cal.save();
    document.getElementById("evtCX").onclick = () => cal.hFormWrap.open = false;
    cal.hfDel.onclick = cal.del;

    // (B3) DRAW DAY NAMES
    let days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    if (cal.mon) { days.push("Sun"); } else { days.unshift("Sun"); }
    for (let d of days) {
      let cell = document.createElement("div");
      cell.className = "calCell";
      cell.innerHTML = d;
      cal.hCD.appendChild(cell);
    }

    // (B4) DRAW CALENDAR
    cal.draw();
  },
  
  // (C) DRAW CALENDAR
  draw : () => {
    // (C1) CALCULATE DAY MONTH YEAR
    // note - jan is 0 & dec is 11 in js
    // note - sun is 0 & sat is 6 in js
    let sMth = parseInt(cal.hMth.value), // selected month
        sYear = parseInt(cal.hYear.value), // selected year
        daysInMth = new Date(sYear, sMth, 0).getDate(), // number of days in selected month
        startDay = new Date(sYear, sMth-1, 1).getDay(), // first day of the month
        endDay = new Date(sYear, sMth-1, daysInMth).getDay(), // last day of the month
        now = new Date(), // current date
        nowMth = now.getMonth()+1, // current month
        nowYear = parseInt(now.getFullYear()), // current year
        nowDay = sMth==nowMth && sYear==nowYear ? now.getDate() : null ;

    // (C2) DRAW CALENDAR ROWS & CELLS
    // (C2-1) INIT + HELPER FUNCTIONS
    let rowA, rowB, rowC, rowMap = {}, rowNum = 1,
        cell, cellNum = 1,
    rower = () => {
      rowA = document.createElement("div");
      rowB = document.createElement("div");
      rowC = document.createElement("div");
      rowA.className = "calRow";
      rowA.id = "calRow" + rowNum;
      rowB.className = "calRowHead";
      rowC.className = "calRowBack";
      cal.hCB.appendChild(rowA);
      rowA.appendChild(rowB);
      rowA.appendChild(rowC);
    },
    celler = day => {
      cell = document.createElement("div");
      cell.className = "calCell";
      if (day) { cell.innerHTML = day; }
      rowB.appendChild(cell);
      cell = document.createElement("div");
      cell.className = "calCell";
      if (day===undefined) { cell.classList.add("calBlank"); }
      if (day==nowDay) { cell.classList.add("calToday"); }
      rowC.appendChild(cell);
    };
    cal.hCB.innerHTML = ""; rower();

    // (C2-2) BLANK CELLS BEFORE START OF MONTH
    if (cal.mon && startDay != 1) {
      let blanks = startDay==0 ? 7 : startDay ;
      for (let i=1; i<blanks; i++) { celler(); cellNum++; }
    }
    if (!cal.mon && startDay != 0) {
      for (let i=0; i<startDay; i++) { celler(); cellNum++; }
    }

    // (C2-3) DAYS OF THE MONTH
    for (let i=1; i<=daysInMth; i++) {
      rowMap[i] = { r : rowNum, c : cellNum };
      celler(i);
      if (cellNum%7==0) { rowNum++; rower(); }
      cellNum++;
    }

    // (C2-4) BLANK CELLS AFTER END OF MONTH
    if (cal.mon && endDay != 0) {
      let blanks = endDay==6 ? 1 : 7-endDay;
      for (let i=0; i<blanks; i++) { celler(); cellNum++; }
    }
    if (!cal.mon && endDay != 6) {
      let blanks = endDay==0 ? 6 : 6-endDay;
      for (let i=0; i<blanks; i++) { celler(); cellNum++; }
    }

    // (C3) FETCH & DRAW EVENTS
    cb.api({
      mod : "calendar", req : "getPeriod",
      data : { month : cal.hMth.value, year : cal.hYear.value },
      passmsg : false,
      onpass : res => {
        cal.events = res.data;
        if (cal.events !== null) { for (let [id,evt] of Object.entries(cal.events)) {
          // (C3-1) EVENT START & END DAY
          let sd = new Date(evt.s), ed = new Date(evt.e);
          sd = sd.getMonth()+1 < sMth ? 1 : sd.getDate();
          ed = ed.getMonth()+1 > sMth ? daysInMth : ed.getDate();

          // (C3-2) "MAP" ONTO HTML CALENDAR
          cell = {}; rowNum = 0;
          for (let i=sd; i<=ed; i++) {
            if (rowNum!=rowMap[i]["r"]) {
              cell[rowMap[i]["r"]] = { s:rowMap[i]["c"], e:0 };
              rowNum = rowMap[i]["r"];
            }
            if (cell[rowNum]) { cell[rowNum]["e"] = rowMap[i]["c"]; }
          }

          // (C3-3) DRAW HTML EVENT ROW
          for (let [r,c] of Object.entries(cell)) {
            let o = c.s - 1 - ((r-1) * 7), // event cell offset
                w = c.e - c.s + 1; // event cell width
            rowA = document.getElementById("calRow"+r);
            rowB = document.createElement("div");
            rowB.className = "calRowEvt";
            rowB.innerHTML = cal.events[id]["t"];
            rowB.style.color = cal.events[id]["c"];
            rowB.style.backgroundColor  = cal.events[id]["b"];
            rowB.classList.add("w"+w);
            if (o!=0) { rowB.classList.add("o"+o); }
            rowB.onclick = () => cal.show(id);
            rowA.appendChild(rowB);
          }
        }}
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
      cal.hfDel.style.display = "inline-block";
    } else {
      cal.hForm.reset();
      cal.hfID.value = "";
      cal.hfDel.style.display = "none";
    }
    cal.hFormWrap.open = true;
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
      alert("Start date cannot be later than end date!");
      return false;
    }

    // (E3) AJAX SAVE
    cb.api({
      mod : "calendar", req : "save",
      data : data,
      onpass : res => {
        cal.hFormWrap.open = false;
        cal.draw();
      }
    });
    return false;
  },

  // (F) DELETE EVENT
  del : () => cb.modal("Please confirm", "Delete this event?", () => cb.api({
    mod : "calendar", req : "del",
    data : { id : cal.hfID.value },
    onpass : res => {
      cal.hFormWrap.open = false;
      cal.draw();
    }
  }))
};
window.addEventListener("load", cal.init);