var nin = {
  // (A) INITIALIZE - CHECK NFC
  init : () => { if ("NDEFReader" in window) {
    document.getElementById("nfc-in").disabled = false;
    nfc.init(nin.go);
  }},

  // (B) LOGIN WITH NFC TOKEN
  go : token => cb.api({
    mod : "nfcin", act : "login",
    data : { token : token },
    passmsg : false,
    onpass : () => location.href = cbhost.base
  })
};

// (C) INIT NFC LOGIN
window.addEventListener("load", nin.init);