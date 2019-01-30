$(window).on('load', function () {
    let token = $('meta[name="csrf-token"]').attr('content');

    // Init web worker
    let worker = fns.init();
    // Get slug for form operations
    fns.getSlug();

    // Get online status
    let online = navigator.onLine;


    if(!online) {
        console.log("Offline mode.");

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
            var formProperties = JSON.parse(jsonData.properties);

            // Render the form, then listen for submit btn click
            Formio.createForm(document.getElementById('form__view'), formProperties).then(function () {
                $('[name="data[submit]"]').on('click', function () {
                    var formData = $('#dynamicForm').serializeArray();

                    // Serialize form to json format
                    var jsonValue = fns.serializeToJson(formData);
                    jsonValue.id = jsonData.id;
                    let options = {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'post',
                        credentials: "same-origin",
                        body: JSON.stringify(jsonValue)
                    };

                    // Submit the form via API
                    fetch('/api/forms/submit', options).then(function(data) {
                        console.log(data);
                    })
                });
            });

        });
        // Sync to live
        // Request web worker to sync data to live db
        worker.postMessage(['syncToLive', token]);

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

            // Render the form
            Formio.createForm(document.getElementById('form__view'), JSON.parse(item.properties)).then(function(){
                $('[name="data[submit]"]').on('click', function () {
                    let formData = $('#dynamicForm').serializeArray();
                    let jsonValue = fns.serializeToJson(formData);
                    jsonValue.formId = item.id;
                    // Request web worker to add data to local db
                    worker.postMessage(['storeInLocal', jsonValue]);
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
    init : () => {
        return new Worker('/assets/website/js/worker.js');
    },
    serializeToJson : (serializedArray) => {
        let keyValue = [];
        serializedArray.forEach((k) => {
            if(k.name !== "_token") {
                keyValue[k.name] = k.value;
            }
        });
        keyValue['slug'] = fns.slug;
        return Object.assign({}, keyValue);
    },
    getSlug: () => {
        let url = window.location.href;
        let urlArray = url.split("/");
        fns.slug = urlArray[urlArray.length - 1];
    },
    getLeftMenu : (menus) => {
        let el = '';
        menus.forEach((menu) => {
            el += '<div class="item-tooltip">' +
                '            <li class="item">' +
                '                <a href="javascript:void(0)"><i class="icon fa fa-home" aria-hidden="true"></i></a>' +
                '                <span class="btn-class">' +
                '                        <a class="menu_item" href="/admin/user/form/' + menu.slug + '">' + menu.title + '</a>' +
                '                    </span>' +
                '            </li>' +
                '            <span class="tooltiptext tooltip-right">' + menu.title + '</span>' +
                '        </div>';
        });
        return el;
    }
}
