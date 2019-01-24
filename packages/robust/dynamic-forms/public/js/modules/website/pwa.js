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

    } else {
        // Display the form
        fetch('/admin/user/form-json/' + fns.slug).then((data) => {
            return data.json();
        }).then((jsonString) => {
            let jsonData = JSON.parse(jsonString);

            // Render the form
            Formio.createForm(document.getElementById('form__show'), jsonData);
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
        console.log('Response:');
        console.log(resp);
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
            Formio.createForm(document.getElementById('form__show'), JSON.parse(item.properties)).then(function(){
                $('[name="data[submit]"]').on('click', function () {
                    let formData = $('#dynamicForm').serializeArray();
                    let jsonValue = fns.serializeToJson(formData);
                    jsonValue.formId = item.id;
                    // Request web worker to add data to local db
                    worker.postMessage(['storeInLocal', jsonValue]);
                });
            });
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
    }
}
