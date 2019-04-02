$(window).on('load', function () {
    // Init web worker
    let worker = fns.init();
    // Get slug for form operations
    fns.getSlug();

    // Get online status
    let online = navigator.onLine;


    if (!online) {
        console.log("Offline mode.");
        // Get offline slug
        fns.getOfflineSlug();

        // Get form from local db
        worker.postMessage(['getForm', fns.slug]);

        // Set the left menu
        // fns.setLeftMenu(localStorage.getItem('user'), localStorage.getItem('app'));

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
            Formio.createForm(document.getElementById('form__view'), formProperties, {
                readOnly: fns.readOnly
            }).then(function (form) {
                if (fns.editMode) {
                    form.submission = $('#form__view').data('values');
                }
                form.on('submit', (submission) => {
                    submission.id = jsonData.id;
                    submission.updated_at = fns.getYMD();
                    // Submit as new data if not in edit mode, else update the existing data
                    fns.editMode ? fns.updateData(submission) : fns.submitData(submission);
                });
                form.on('error', (errors) => {

                });

                form.on('change', function (change) {
                    if (window.innerWidth < 500) {
                        // Set slick class to display none if the formio component is hidden & vice versa
                        $('.form-group').each(function () {
                            if ($(this).attr('hidden') !== undefined) {
                                $(this).parent().parent().attr('style', 'display: none;');
                            } else {
                                $(this).parent().parent().attr('style', 'display: block;');
                            }
                        });
                    }
                });

                form.on('render', (rendered) => {
                    setTimeout(function () {
                        $('.form--slider').children(":first").addClass('mobile--slider');
                        if (window.innerWidth < 500) {
                            $('.form--slider .mobile--slider').slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: true
                            });

                            // Set slick class to display none if the formio component is hidden & vice versa
                            $('.form-group').each(function () {
                                if ($(this).attr('hidden') !== undefined) {
                                    $(this).parent().parent().attr('style', 'display: none;');
                                } else {
                                    $(this).parent().parent().attr('style', 'display: block;');
                                }
                            });
                        }
                    }, 1000)

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
    worker.addEventListener('message', function (e) {
        let resp = e.data;
        if (resp.type === "storeInLocal") {
            // If store successful
            if (resp.status) {
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
            Formio.createForm(document.getElementById('form__view'), JSON.parse(item.properties)).then(function (form) {
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
        //
        }
    });
});

const fns = {
    slug: '',
    token: $('meta[name="csrf-token"]').attr('content'),
    readOnlyMode: false,
    editMode: false,
    options: {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": ''
        },
        method: 'post',
        credentials: "same-origin",
    },
    init: () => {
        localStorage.setItem('user', $('#info').data('id'));
        localStorage.setItem('app', $('#info').data('url'));
        // Set token in options' header
        fns.options.headers['X-CSRF-TOKEN'] = fns.token;
        // Set modes for form if it's readonly / editable / new form etc.
        fns.setFormMode();
        return new Worker('/assets/website/js/worker.js');
    },
    setFormMode: () => {
        let field = $('#form__view').data('mode');
        if (typeof field !== 'undefined') {
            fns.readOnly = field === "readonly";
            fns.editMode = field === "edit";
        }
    },
    submitData: (data) => {
        fns.options.body = JSON.stringify(data);
        // Submit the form via API
        fetch('/api/forms/submit', fns.options).then(function (data) {
            // Set submit button as form submitted
            $('.glyphicon-refresh.glyphicon-spin').remove();
            $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-success submit-success');

            console.log(data);
        });
    },
    updateData: (data) => {
        data.update_id = $('#form__view').data('id');
        fns.options.body = JSON.stringify(data);
        // Submit the form via API
        fetch('/api/forms/update', fns.options).then(function (data) {
            // Set submit button as form submitted
            $('.glyphicon-refresh.glyphicon-spin').remove();
            $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-success submit-success');
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

        return (year + "-" + month + "-" + day + " " + time);
    },
    setLeftMenu: (user, url) => {
        let el = '';

        if(user == 1) {
            el += '<div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-apps" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" data-toggle="collapse" href="#Dashboards">Dashboards</a>' +
                '                                                            <a class="" data-toggle="collapse" href="#Dashboards"><i class="fa fa-plus"></i></a>' +
                '                                                        </span>' +
                '                        <ul id="Dashboards" class="sub-menu collapse">' +
                '                                                            <li>' +
                '                                    <a href="' + url + '/admin/dashboards">Dashboards</a>' +
                '                                </li>' +
                '                                                            <li>' +
                '                                    <a href="' + url + '/admin/widgets">Widgets</a>' +
                '                                </li>' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">Dashboards</span>' +
                '                </div>' +
                '                                                                                                <div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-home" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" data-toggle="collapse" href="#DatabaseManagement">Database Management</a>' +
                '                                                            <a class="" data-toggle="collapse" href="#DatabaseManagement"><i class="fa fa-plus"></i></a>' +
                '                                                        </span>' +
                '                        <ul id="DatabaseManagement" class="sub-menu collapse">' +
                '                                                            <li>' +
                '                                    <a href="' + url + '/admin/backup">Back Up</a>' +
                '                                </li>' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">Database Management</span>' +
                '                </div>' +
                '                                                                                                <div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-settings" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" href="' + url + '/admin/email-settings">Email-Settings</a>' +
                '                                                        </span>' +
                '                        <ul id="Email-Settings" class="sub-menu collapse">' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">Email-Settings</span>' +
                '                </div>' +
                '                                                                                                <div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-assignment-o" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" href="' + url + '/admin/forms">Form Manager</a>' +
                '                                                        </span>' +
                '                        <ul id="FormManager" class="sub-menu collapse">' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">Form Manager</span>' +
                '                </div>' +
                '                                                                                                                                                                <div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-image" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" href="' + url + '/admin/medias">Media Manager</a>' +
                '                                                        </span>' +
                '                        <ul id="MediaManager" class="sub-menu collapse">' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">Media Manager</span>' +
                '                </div>' +
                '                                                                                                                                                                                    <div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-accounts-add" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" data-toggle="collapse" href="#UserManagement">User Management</a>' +
                '                                                            <a class="" data-toggle="collapse" href="#UserManagement"><i class="fa fa-plus"></i></a>' +
                '                                                        </span>' +
                '                        <ul id="UserManagement" class="sub-menu collapse">' +
                '                                                            <li>' +
                '                                    <a href="' + url + '/admin/roles">Roles</a>' +
                '                                </li>' +
                '                                                            <li>' +
                '                                    <a href="' + url + '/admin/users">Users</a>' +
                '                                </li>' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">User Management</span>' +
                '                </div>';
        } else {
            el = '<div class="item-tooltip">' +
                '                    <li class="item">' +
                '                        <a href="javascript:void(0)"><i class="icon md-assignment-o" aria-hidden="true"></i></a>' +
                '                        <span class="btn-class">' +
                '                        <a class="menu_item" href="' + url + '/admin/forms">Form Manager</a>' +
                '                                                        </span>' +
                '                        <ul id="FormManager" class="sub-menu collapse">' +
                '                                                    </ul>' +
                '                    </li>' +
                '                    <span class="tooltiptext tooltip-right">Form Manager</span>' +
                '                </div>' +
                '                                 ';
        }
        
        $('#theMenu').html(el); 
    }
};
