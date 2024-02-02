var unfc = {
  // (A) SHOW WRITE NFC PAGE
  hBtn : null, // html write nfc button
  hNull : null, // html null token button
  show : id => cb.load({
    page : "admin/users/nfc", target : "cb-page-2",
    data : { id : id },
    onload : () => {
      unfc.hBtn = document.getElementById("nfc-btn");
      unfc.hNull = document.getElementById("nfc-null");
      if ("NDEFReader" in window) { unfc.hBtn.disabled = false; }
      cb.page(2);
    }
  }),

  // (B) CREATE NEW NFC LOGIN TAG
  add : id => cb.api({
    mod : "nfcin", act : "add",
    data : { id : id },
    passmsg : false,
    onpass : res => {
      unfc.hNull.disabled = false;
      nfc.write(res.data);
    }
  }),

  // (C) NULLIFY NFC TOKEN
  null : id => cb.api({
    mod : "nfcin", act : "del",
    data : { id : id },
    passmsg : "Login token nullified.",
    onpass : res => unfc.hNull.disabled = true
  })
};

// (D) ATTACH NFC WRITER
window.addEventListener("load", () => {
  if (("NDEFReader" in window)) { nfc.init(); }
});