importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.5.0/workbox-sw.js');

if (workbox) {
    let online = navigator.onLine;
    console.log(online);
    // Debug mode set to true
    workbox.setConfig({ debug: true });

    workbox.precaching.precacheAndRoute([]);
    workbox.routing.registerRoute(
       '/',
        workbox.strategies.networkFirst()
    );

    workbox.routing.registerRoute(
        /.*\/admin\/user\/form\/.*/,
        workbox.strategies.cacheFirst()
    );

    workbox.routing.registerRoute(
        /.*\/user\/dashboards.*/,
        workbox.strategies.networkFirst()
    );

    workbox.routing.registerRoute(
        /.*\/assets\/css\/app.min.*/,
        function() {
            return online ? false : caches.match('/assets/css/app.min.css');
        }
    );
    workbox.routing.registerRoute(
        /.*\/assets\/css\/app-1.min.*/,
        function() {
            return online ? false : caches.match('/assets/css/app-1.min.css');
        }
    );

    workbox.routing.registerRoute(
        /.*\/assets\/js\/app.min.js.*/,
        function() {
            return online ? false : caches.match('/assets/js/app.min.js');
        }
    );

    workbox.routing.registerRoute(
        /.*\/assets\/fonts\/material-design\/Material-Design-Iconic-Font.woff.*/,
        function() {
            return online ? false : caches.match('/assets/fonts/material-design/Material-Design-Iconic-Font.woff');
        }
    );

    workbox.routing.registerRoute(
        /.*\/assets\/fonts\/material-design\/Material-Design-Iconic-Font.woff2.*/,
        function() {
            return online ? false : caches.match('/assets/fonts/material-design/Material-Design-Iconic-Font.woff2');
        }
    );


} else {
    console.log(`Boo! Workbox didn't load 😬`);
}
