importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.5.0/workbox-sw.js');

if (workbox) {
    let online = navigator.onLine;

    const customHandler = async (args) => {
        try {
            return await workbox.strategies.networkFirst({
                cacheName: 'pages'
            }).handle(args) || caches.match('/assets/website/html/layout.html')
        } catch (error) {
            return caches.match('/assets/website/html/layout.html')
        }
    }

    // Debug mode set to true
    workbox.setConfig({ debug: true });
    workbox.core.setLogLevel(workbox.core.LOG_LEVELS.debug);

    workbox.precaching.precacheAndRoute([]);

    workbox.routing.registerRoute(
       '/admin/user/dashboards',
        workbox.strategies.networkFirst()
    );

    workbox.routing.registerRoute(
        /.*\/admin\/forms\/.*/,
        customHandler
    );

    workbox.routing.registerRoute(
        /.*\/admin\/forms.*/,
        workbox.strategies.networkFirst()
    );



    // workbox.routing.registerRoute(
    //     new RegExp('/admin/forms/.*'),
    //     customHandler
    // );

    // const handlerCb = ({url, event, params}) => {
    //     return fetch(event.request)
    //         .then((response) => {
    //             return response.text();
    //         })
    //         .then((responseBody) => {
    //             return caches.match('/assets/website/html/layout.html');
    //         });
    // };

    // const articleHandler = () => {
    //    return !online ? new Response(caches.match('/assets/website/html/layout.html')) : ;
    // };

    //
    //
    // workbox.routing.registerRoute(
    //     new RegExp('/admin/user/form/.*'),
    //     async ({event}) => {
    //         try {
    //             return await handle({event});
    //         } catch (error) {
    //             return caches.match('/assets/website/html/layout.html');
    //         }
    //     }
    // );

    //
    // workbox.routing.registerRoute(
    //     /.*\/assets\/css\/app.min.*/,
    //     function() {
    //         return online ? false : caches.match('/assets/css/app.min.css');
    //     }
    // );

    // workbox.routing.registerRoute(
    //     /.*\/assets\/css\/app-1.min.*/,
    //     function() {
    //         return online ? false : caches.match('/assets/css/app-1.min.css');
    //     }
    // );

    // workbox.routing.registerRoute(
    //     /.*\/assets\/js\/app.min.js.*/,
    //     function() {
    //         return online ? false : caches.match('/assets/js/app.min.js');
    //     }
    // );
    //


    const fontHandler = async (args) => {
        try {
            return await workbox.strategies.networkFirst().handle(args) || caches.match('/assets/fonts/material-design/Material-Design-Iconic-Font.woff')
        } catch (error) {
            return caches.match('/assets/fonts/material-design/Material-Design-Iconic-Font.woff')
        }
    }

    const fontHandler2 = async (args) => {
        try {
            return await workbox.strategies.networkFirst().handle(args) || caches.match('/assets/fonts/material-design/Material-Design-Iconic-Font.woff2')
        } catch (error) {
            return caches.match('/assets/fonts/material-design/Material-Design-Iconic-Font.woff2')
        }
    }
    workbox.routing.registerRoute(
        /.*\/assets\/fonts\/material-design\/Material-Design-Iconic-Font.woff.*/,
        fontHandler
    );

    workbox.routing.registerRoute(
        /.*\/assets\/fonts\/material-design\/Material-Design-Iconic-Font.woff2.*/,
        fontHandler2
    );
} else {
    console.log(`Boo! Workbox didn't load 😬`);
}
