// (A) FILES TO CACHE
const cName = "cb-pwa",
cFiles = [
  "assets/ico-512.png",
  "assets/favicon.png",
  "assets/maticon.woff2",
  "assets/bootstrap.bundle.min.js",
  "assets/bootstrap.bundle.min.js.map",
  "assets/bootstrap.min.css",
  "assets/bootstrap.min.css.map",
  "assets/PAGE-cb.js"
  // @TODO - ADD MORE OF YOUR OWN TO CACHE
];

// (B) CREATE/INSTALL CACHE
self.addEventListener("install", evt => evt.waitUntil(
  caches.open(cName)
  .then(cache => cache.addAll(cFiles))
  .catch(err => console.error(err))
));

// (C) LOAD FROM CACHE FIRST, FALLBACK TO NETWORK IF NOT FOUND
self.addEventListener("fetch", evt => evt.respondWith(
  caches.match(evt.request).then(res => res || fetch(evt.request))
));

/* (C) LOAD WITH NETWORK FIRST, FALLBACK TO CACHE IF OFFLINE
self.addEventListener("fetch", evt => evt.respondWith(
  fetch(evt.request).catch(() => caches.match(evt.request))
)); */