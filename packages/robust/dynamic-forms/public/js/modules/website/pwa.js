$(window).on('load', function () {
    // Init web worker
    let worker = fns.init();
    // Get slug for form operations
    fns.getSlug();

    // Get online status
    let online = navigator.onLine;


    if(!online) {
        console.log("Offline mode.");
        // Get offline slug
        fns.getOfflineSlug();

        // Get form from local db
        worker.postMessage(['getForm', fns.slug]);

        // Get all forms
        worker.postMessage(['getAllForms']);

    } else {
        // Handle online form submission
        // Get form with the slug on request
        fetch('/admin/user/form-json/' + fns.slug).then(function (data) {
            return data.json();
        }).then(function (jsonString) {
            // We get all values from dynform_values table
            let jsonData = jsonString;
            let formProperties = JSON.parse(jsonData.properties);

            // Render the form, then listen for submit btn click
            Formio.createForm(document.getElementById('form__view'), formProperties).then(function (form) {
                form.on('submit', (submission) => {
                    submission.id = jsonData.id;
                    submission.updated_at = fns.getYMD();
                    fns.submitData(submission);
                });
                form.on('error', (errors) => {

                });
            });

        });
        // Sync to live
        // Request web worker to sync data to live db
        worker.postMessage(['syncToLive', fns.token]);

        // Sync forms from live to local
        worker.postMessage(['syncForms']);
    }

    // Receive messages from web worker
    worker.addEventListener('message', function(e) {
        let resp = e.data;
        if(resp.type === "storeInLocal") {
            // If store successful
            if(resp.status) {
                $('.glyphicon-refresh.glyphicon-spin').remove();
                $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-success submit-success');
            } else {
                $('.glyphicon-refresh.glyphicon-spin').remove();
                $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-danger submit-fail');
            }
        } else if (resp.type === "syncToLive") {
            console.log(resp.status);
        } else if (resp.type === "getForm") {
            let item = resp.data;
            // Set title of the form page
            $('#form-title').html(item.title);
            // Render the form
            Formio.createForm(document.getElementById('form__view'), JSON.parse(item.properties)).then(function(form){
                form.on('submit', (submission) => {
                    submission.formId = item.id;
                    submission.updated_at = fns.getYMD();
                    // Request web worker to add data to local db
                    worker.postMessage(['storeInLocal', submission]);
                });
                form.on('error', (errors) => {

                });
            });
        } else if (resp.type === "getAllForms") {
            let menus = resp.data;
            let leftMenu = fns.getLeftMenu(menus);
            $('#theMenu').html(leftMenu);
        }
    });
});

const fns = {
    slug: '',
    token: $('meta[name="csrf-token"]').attr('content'),
    init : () => {
        return new Worker('/assets/website/js/worker.js');
    },
    submitData: (data) => {
        let options = {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": fns.token
            },
            method: 'post',
            credentials: "same-origin",
            body: JSON.stringify(data)
        };

        // Submit the form via API
        fetch('/api/forms/submit', options).then(function (data) {
            // Set submit button as form submitted
            $('.glyphicon-refresh.glyphicon-spin').remove();
            $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-success submit-success');

            console.log(data);
        });
    },
    getSlug: () => {
        fns.slug = $('#form__view').data('slug');
    },
    getOfflineSlug: () => {
        let url = window.location.href;
        let urlArray = url.split("/");
        fns.slug = urlArray[urlArray.length - 1];
    },
    getYMD: () => {
        let dateObj = new Date();
        let month = dateObj.getUTCMonth() + 1; //months from 1-12
        let day = dateObj.getUTCDate();
        let year = dateObj.getUTCFullYear();
        let time = dateObj.getHours() + ":" + dateObj.getMinutes() + ":" + dateObj.getSeconds();

        return(year + "-" + month + "-" + day + " " + time);
    },
    getLeftMenu : (menus) => {
        let el = '';
        menus.forEach((menu) => {
            el += '<div class="item-tooltip">' +
                '            <li class="item">' +
                '                <a href="javascript:void(0)"><i class="icon fa fa-home" aria-hidden="true"></i></a>' +
                '                <span class="btn-class">' +
                '                        <a class="menu_item" href="/admin/forms/' + menu.id + '">' + menu.title + '</a>' +
                '                    </span>' +
                '            </li>' +
                '            <span class="tooltiptext tooltip-right">' + menu.title + '</span>' +
                '        </div>';
        });
        return el;
    }
}
