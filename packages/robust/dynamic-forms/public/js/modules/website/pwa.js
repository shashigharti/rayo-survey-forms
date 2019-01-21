$(window).on('load', function () {
    let token = $('meta[name="csrf-token"]').attr('content');
    var online = navigator.onLine;

    var worker = fns.init();
    if(!online) {
        console.log("Offline mode.");
        $('[name="data[submit]"]').on('click', function() {
            let formData = $('#dynamicForm').serializeArray();
            let jsonValue = fns.serializeToJson(formData);
            // Request web worker to add data to local db
            worker.postMessage(['storeInLocal', jsonValue]);
        });
    } else {
        // Sync to live
        // Request web worker to sync data to live db
        worker.postMessage(['syncToLive', token]);
    }

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
        }
    });
});

const fns = {
    init : () => {
        return new Worker('../assets/website/js/worker.js');
    },
    serializeToJson : (serializedArray) => {
        let keyValue = [];
        serializedArray.forEach((k) => {
            if(k.name !== "_token") {
                keyValue[k.name] = k.value;
            }
        });
        return Object.assign({}, keyValue);
    }
}
