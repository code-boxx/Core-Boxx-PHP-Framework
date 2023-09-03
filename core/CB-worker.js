// (A) CREATE/INSTALL CACHE
self.addEventListener("install", evt => {
  self.skipWaiting();
  evt.waitUntil(
    caches.open("CoreBoxx")
    .then(cache => cache.addAll([
      // (A1) BOOTSTRAP
      "assets/bootstrap.bundle.min.js",
      "assets/bootstrap.bundle.min.js.map",
      "assets/bootstrap.min.css",
      "assets/bootstrap.min.css.map",
      // (A2) ICONS + IMAGES
      "assets/ico-512.png",
      "assets/favicon.png",
      // (A3) COMMON INTERFACE
      "assets/icomoon.woff",
      "assets/PAGE-cb.js",
      "assets/PAGE-cb.css",
      "CB-manifest.json"
      // @TODO - ADD MORE OF YOUR OWN TO CACHE
    ]))
    .catch(err => console.error(err))
  );
});

// (B) CLAIM CONTROL INSTANTLY
self.addEventListener("activate", evt => self.clients.claim());

// (C) LOAD FROM CACHE FIRST, FALLBACK TO NETWORK IF NOT FOUND
self.addEventListener("fetch", evt => evt.respondWith(
  caches.match(evt.request).then(res => res || fetch(evt.request))
));

/* (C) LOAD WITH NETWORK FIRST, FALLBACK TO CACHE IF OFFLINE
self.addEventListener("fetch", evt => evt.respondWith(
  fetch(evt.request).catch(() => caches.match(evt.request))
)); */

// (D) LISTEN TO PUSH NOTIFICATIONS
self.addEventListener("push", evt => {
  const data = evt.data.json();
  self.registration.showNotification(data.title, {
    body: data.body,
    icon: data.icon,
    image: data.image
  });
});