var pusher = {
  // (A) PROPERTIES
  hStat : null, // html status
  worker : null, // registered service worker
  sub : null, // push notification subscription

  // (B) HELPER - SHOW HTML MESSAGE
  show : (msg, good) => {
    let ico = `<i class="ico-sm icon-${good?"checkmark":"cross"}"></i> `;
    pusher.hStat.innerHTML = ico + msg;
    if (good) { pusher.hStat.className = "p-2 bg-success text-white"; }
  },

  // (C) INIT
  init : async () => {
    // (C1) GET HTML STATUS
    pusher.hStat = document.getElementById("push-stat");

    // (C2) FEATURE CHECK
    if (!("serviceWorker" in navigator)) {
      pusher.show("Service worker not supported.");
      return false;
    }
    if (!("Notification" in window)) {
      pusher.show("Push notifications not supported.");
      return false;
    }

     // (C3) PUSH NOTIFICATIONS SETUP
     navigator.serviceWorker.ready.then(reg => {
      pusher.worker = reg;
      if (Notification.permission == "default") {
        Notification.requestPermission()
        .then(perm => {
          if (perm == "granted") { pusher.reg(); }
          else { pusher.show("Notifications denied - Manually enable permissions to allow low stock warning."); }
        })
        .catch(err => pusher.show("ERROR - " + err.message));
      } else if (Notification.permission == "granted") {
        pusher.reg();
      } else {
        pusher.show("Notifications denied - Manually enable permissions to allow low stock warning.");
      }
    })
    .catch(err => {
      pusher.show("ERROR - " + err.message);
      console.error(err);
    });
  },

  // (D) REGISTER PUSH NOTIFICATIONS
  reg : () => {
    pusher.worker.pushManager.getSubscription()
    .then(sub => {
      if (sub==null) {
        pusher.worker.pushManager.subscribe({
          userVisibleOnly: true,
          applicationServerKey: cbvapid
        })
        .then(sub => { pusher.sub = sub; pusher.save(); })
        .catch(err => pusher.show("ERROR - " + err.message));
      } else { pusher.sub = sub; pusher.save(); }
    })
    .catch(err => pusher.show("ERROR - " + err.message));
  },

  // (E) UPDATE SERVER SUBSCRIPTION
  save : () => cb.api({
    mod : "push", act : "save",
    data : {
      endpoint : pusher.sub.endpoint,
      sub : JSON.stringify(pusher.sub)
    },
    passmsg : false,
    onpass : () => pusher.show("Push notifications good to go.", 1)
  })
};
window.addEventListener("load", pusher.init);