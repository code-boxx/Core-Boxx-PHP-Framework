function activate () {
  cb.api({
    mod : "session", act : "activate",
    data : {
      id : document.getElementById("activate-email").value
    },
    passmsg : false,
    onpass : () => cb.modal("Sent", "Please click on the activation link in your email.")
  });
  return false;
}