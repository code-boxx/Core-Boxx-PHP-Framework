var uqr = {
  // (A) SHOW WRITE QR PAGE
  hqNull : null, // html null token button
  show : id => cb.load({
    page : "admin/users/qr", target : "cb-page-2",
    data : { id : id },
    onload : () => {
      uqr.hqNull = document.getElementById("qr-null");
      cb.page(2);
    }
  }),

  // (B) NULLIFY QR TOKEN
  null : id => cb.api({
    mod : "qrin", act : "del",
    data : { id : id },
    passmsg : "Login token nullified.",
    onpass : res => uqr.hqNull.disabled = true
  })
};