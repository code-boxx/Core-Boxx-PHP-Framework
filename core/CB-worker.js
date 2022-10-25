// (A) FILES TO CACHE
const cName = "coreboxx",
cFiles = [
  // (A1) BOOTSTRAP
  "assets/bootstrap.bundle.min.js",
  "assets/bootstrap.bundle.min.js.map",
  "assets/bootstrap.min.css",
  "assets/bootstrap.min.css.map",
  // (A2) ICONS + IMAGES
  "assets/ico-512.png",
  "assets/favicon.png",
  // (A3) COMMON INTERFACE
  "assets/maticon.woff2",
  "assets/PAGE-cb.js",
  "CB-manifest.json"
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