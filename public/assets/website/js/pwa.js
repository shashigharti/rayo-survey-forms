(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

$(window).on('load', function () {
    // Init web worker
    var worker = fns.init();
    // Get slug for form operations
    fns.getSlug();

    // Get online status
    var online = navigator.onLine;

    if (!online) {
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
            var jsonData = jsonString;
            var formProperties = JSON.parse(jsonData.properties);

            // Render the form, then listen for submit btn click
            Formio.createForm(document.getElementById('form__view'), formProperties, {
                readOnly: fns.readOnly
            }).then(function (form) {
                if (fns.editMode) {
                    form.submission = $('#form__view').data('values');
                }
                form.on('submit', function (submission) {
                    submission.id = jsonData.id;
                    submission.updated_at = fns.getYMD();
                    // Submit as new data if not in edit mode, else update the existing data
                    fns.editMode ? fns.updateData(submission) : fns.submitData(submission);
                });
                form.on('error', function (errors) {});

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

                form.on('render', function (rendered) {
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
                    }, 1000);
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
        var resp = e.data;
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
            var item = resp.data;
            // Set title of the form page
            $('#form-title').html(item.title);
            // Render the form
            Formio.createForm(document.getElementById('form__view'), JSON.parse(item.properties)).then(function (form) {
                form.on('submit', function (submission) {
                    submission.formId = item.id;
                    submission.updated_at = fns.getYMD();
                    // Request web worker to add data to local db
                    worker.postMessage(['storeInLocal', submission]);
                });
                form.on('error', function (errors) {});
            });
        } else if (resp.type === "getAllForms") {
            var menus = resp.data;
            var leftMenu = fns.getLeftMenu(menus);
            $('#theMenu').html(leftMenu);
        }
    });
});

var fns = {
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
        credentials: "same-origin"
    },
    init: function init() {
        // Set token in options' header
        fns.options.headers['X-CSRF-TOKEN'] = fns.token;
        // Set modes for form if it's readonly / editable / new form etc.
        fns.setFormMode();
        return new Worker('/assets/website/js/worker.js');
    },
    setFormMode: function setFormMode() {
        var field = $('#form__view').data('mode');
        if (typeof field !== 'undefined') {
            fns.readOnly = field === "readonly";
            fns.editMode = field === "edit";
        }
    },
    submitData: function submitData(data) {
        fns.options.body = JSON.stringify(data);
        // Submit the form via API
        fetch('/api/forms/submit', fns.options).then(function (data) {
            // Set submit button as form submitted
            $('.glyphicon-refresh.glyphicon-spin').remove();
            $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-success submit-success');

            console.log(data);
        });
    },
    updateData: function updateData(data) {
        data.update_id = $('#form__view').data('id');
        fns.options.body = JSON.stringify(data);
        // Submit the form via API
        fetch('/api/forms/update', fns.options).then(function (data) {
            // Set submit button as form submitted
            $('.glyphicon-refresh.glyphicon-spin').remove();
            $('[name="data[submit]"]').attr('class', 'btn btn-primary btn-md btn-success submit-success');
        });
    },
    getSlug: function getSlug() {
        fns.slug = $('#form__view').data('slug');
    },
    getOfflineSlug: function getOfflineSlug() {
        var url = window.location.href;
        var urlArray = url.split("/");
        fns.slug = urlArray[urlArray.length - 1];
    },
    getYMD: function getYMD() {
        var dateObj = new Date();
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        var time = dateObj.getHours() + ":" + dateObj.getMinutes() + ":" + dateObj.getSeconds();

        return year + "-" + month + "-" + day + " " + time;
    },
    getLeftMenu: function getLeftMenu(menus) {
        var el = '';
        menus.forEach(function (menu) {
            el += '<div class="item-tooltip">' + '            <li class="item">' + '                <a href="javascript:void(0)"><i class="icon fa fa-home" aria-hidden="true"></i></a>' + '                <span class="btn-class">' + '                        <a class="menu_item" href="/admin/forms/' + menu.id + '">' + menu.title + '</a>' + '                    </span>' + '            </li>' + '            <span class="tooltiptext tooltip-right">' + menu.title + '</span>' + '        </div>';
        });
        return el;
    }
};
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImZha2VfMjUzMmZhZGQuanMiXSwibmFtZXMiOlsiJCIsIndpbmRvdyIsIm9uIiwid29ya2VyIiwiZm5zIiwiaW5pdCIsImdldFNsdWciLCJvbmxpbmUiLCJuYXZpZ2F0b3IiLCJvbkxpbmUiLCJjb25zb2xlIiwibG9nIiwiZ2V0T2ZmbGluZVNsdWciLCJwb3N0TWVzc2FnZSIsInNsdWciLCJmZXRjaCIsInRoZW4iLCJkYXRhIiwianNvbiIsImpzb25TdHJpbmciLCJqc29uRGF0YSIsImZvcm1Qcm9wZXJ0aWVzIiwiSlNPTiIsInBhcnNlIiwicHJvcGVydGllcyIsIkZvcm1pbyIsImNyZWF0ZUZvcm0iLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwicmVhZE9ubHkiLCJmb3JtIiwiZWRpdE1vZGUiLCJzdWJtaXNzaW9uIiwiaWQiLCJ1cGRhdGVkX2F0IiwiZ2V0WU1EIiwidXBkYXRlRGF0YSIsInN1Ym1pdERhdGEiLCJlcnJvcnMiLCJjaGFuZ2UiLCJpbm5lcldpZHRoIiwiZWFjaCIsImF0dHIiLCJ1bmRlZmluZWQiLCJwYXJlbnQiLCJyZW5kZXJlZCIsInNldFRpbWVvdXQiLCJjaGlsZHJlbiIsImFkZENsYXNzIiwic2xpY2siLCJzbGlkZXNUb1Nob3ciLCJzbGlkZXNUb1Njcm9sbCIsImFycm93cyIsInRva2VuIiwiYWRkRXZlbnRMaXN0ZW5lciIsImUiLCJyZXNwIiwidHlwZSIsInN0YXR1cyIsInJlbW92ZSIsIml0ZW0iLCJodG1sIiwidGl0bGUiLCJmb3JtSWQiLCJtZW51cyIsImxlZnRNZW51IiwiZ2V0TGVmdE1lbnUiLCJyZWFkT25seU1vZGUiLCJvcHRpb25zIiwiaGVhZGVycyIsIm1ldGhvZCIsImNyZWRlbnRpYWxzIiwic2V0Rm9ybU1vZGUiLCJXb3JrZXIiLCJmaWVsZCIsImJvZHkiLCJzdHJpbmdpZnkiLCJ1cGRhdGVfaWQiLCJ1cmwiLCJsb2NhdGlvbiIsImhyZWYiLCJ1cmxBcnJheSIsInNwbGl0IiwibGVuZ3RoIiwiZGF0ZU9iaiIsIkRhdGUiLCJtb250aCIsImdldFVUQ01vbnRoIiwiZGF5IiwiZ2V0VVRDRGF0ZSIsInllYXIiLCJnZXRVVENGdWxsWWVhciIsInRpbWUiLCJnZXRIb3VycyIsImdldE1pbnV0ZXMiLCJnZXRTZWNvbmRzIiwiZWwiLCJmb3JFYWNoIiwibWVudSJdLCJtYXBwaW5ncyI6Ijs7QUFBQUEsRUFBRUMsTUFBRixFQUFVQyxFQUFWLENBQWEsTUFBYixFQUFxQixZQUFZO0FBQzdCO0FBQ0EsUUFBSUMsU0FBU0MsSUFBSUMsSUFBSixFQUFiO0FBQ0E7QUFDQUQsUUFBSUUsT0FBSjs7QUFFQTtBQUNBLFFBQUlDLFNBQVNDLFVBQVVDLE1BQXZCOztBQUdBLFFBQUksQ0FBQ0YsTUFBTCxFQUFhO0FBQ1RHLGdCQUFRQyxHQUFSLENBQVksZUFBWjtBQUNBO0FBQ0FQLFlBQUlRLGNBQUo7O0FBRUE7QUFDQVQsZUFBT1UsV0FBUCxDQUFtQixDQUFDLFNBQUQsRUFBWVQsSUFBSVUsSUFBaEIsQ0FBbkI7O0FBRUE7QUFDQVgsZUFBT1UsV0FBUCxDQUFtQixDQUFDLGFBQUQsQ0FBbkI7QUFFSCxLQVhELE1BV087QUFDSDtBQUNBO0FBQ0FFLGNBQU0sMkJBQTJCWCxJQUFJVSxJQUFyQyxFQUEyQ0UsSUFBM0MsQ0FBZ0QsVUFBVUMsSUFBVixFQUFnQjtBQUM1RCxtQkFBT0EsS0FBS0MsSUFBTCxFQUFQO0FBQ0gsU0FGRCxFQUVHRixJQUZILENBRVEsVUFBVUcsVUFBVixFQUFzQjtBQUMxQjtBQUNBLGdCQUFJQyxXQUFXRCxVQUFmO0FBQ0EsZ0JBQUlFLGlCQUFpQkMsS0FBS0MsS0FBTCxDQUFXSCxTQUFTSSxVQUFwQixDQUFyQjs7QUFFQTtBQUNBQyxtQkFBT0MsVUFBUCxDQUFrQkMsU0FBU0MsY0FBVCxDQUF3QixZQUF4QixDQUFsQixFQUF5RFAsY0FBekQsRUFBeUU7QUFDckVRLDBCQUFVekIsSUFBSXlCO0FBRHVELGFBQXpFLEVBRUdiLElBRkgsQ0FFUSxVQUFVYyxJQUFWLEVBQWdCO0FBQ3BCLG9CQUFJMUIsSUFBSTJCLFFB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RlUsQ0FFNkI7QUFDdkMsWUFBSUMsTUFBTUosUUFBUUssVUFBUixFQUFWO0FBQ0EsWUFBSUMsT0FBT04sUUFBUU8sY0FBUixFQUFYO0FBQ0EsWUFBSUMsT0FBT1IsUUFBUVMsUUFBUixLQUFxQixHQUFyQixHQUEyQlQsUUFBUVUsVUFBUixFQUEzQixHQUFrRCxHQUFsRCxHQUF3RFYsUUFBUVcsVUFBUixFQUFuRTs7QUFFQSxlQUFRTCxPQUFPLEdBQVAsR0FBYUosS0FBYixHQUFxQixHQUFyQixHQUEyQkUsR0FBM0IsR0FBaUMsR0FBakMsR0FBdUNJLElBQS9DO0FBQ0gsS0FsRU87QUFtRVIxQixpQkFBYSxxQkFBQ0YsS0FBRCxFQUFXO0FBQ3BCLFlBQUlnQyxLQUFLLEVBQVQ7QUFDQWhDLGNBQU1pQyxPQUFOLENBQWMsVUFBQ0MsSUFBRCxFQUFVO0FBQ3BCRixrQkFBTSwrQkFDRiwrQkFERSxHQUVGLHFHQUZFLEdBR0YsMENBSEUsR0FJRixrRUFKRSxHQUltRUUsS0FBS2pFLEVBSnhFLEdBSTZFLElBSjdFLEdBSW9GaUUsS0FBS3BDLEtBSnpGLEdBSWlHLE1BSmpHLEdBS0YsNkJBTEUsR0FNRixtQkFORSxHQU9GLHNEQVBFLEdBT3VEb0MsS0FBS3BDLEtBUDVELEdBT29FLFNBUHBFLEdBUUYsZ0JBUko7QUFTSCxTQVZEO0FBV0EsZUFBT2tDLEVBQVA7QUFDSDtBQWpGTyxDQUFaIiwiZmlsZSI6ImZha2VfMjUzMmZhZGQuanMiLCJzb3VyY2VzQ29udGVudCI6WyIkKHdpbmRvdykub24oJ2xvYWQnLCBmdW5jdGlvbiAoKSB7XG4gICAgLy8gSW5pdCB3ZWIgd29ya2VyXG4gICAgbGV0IHdvcmtlciA9IGZucy5pbml0KCk7XG4gICAgLy8gR2V0IHNsdWcgZm9yIGZvcm0gb3BlcmF0aW9uc1xuICAgIGZucy5nZXRTbHVnKCk7XG5cbiAgICAvLyBHZXQgb25saW5lIHN0YXR1c1xuICAgIGxldCBvbmxpbmUgPSBuYXZpZ2F0b3Iub25MaW5lO1xuXG5cbiAgICBpZiAoIW9ubGluZSkge1xuICAgICAgICBjb25zb2xlLmxvZyhcIk9mZmxpbmUgbW9kZS5cIik7XG4gICAgICAgIC8vIEdldCBvZmZsaW5lIHNsdWdcbiAgICAgICAgZm5zLmdldE9mZmxpbmVTbHVnKCk7XG5cbiAgICAgICAgLy8gR2V0IGZvcm0gZnJvbSBsb2NhbCBkYlxuICAgICAgICB3b3JrZXIucG9zdE1lc3NhZ2UoWydnZXRGb3JtJywgZm5zLnNsdWddKTtcblxuICAgICAgICAvLyBHZXQgYWxsIGZvcm1zXG4gICAgICAgIHdvcmtlci5wb3N0TWVzc2FnZShbJ2dldEFsbEZvcm1zJ10pO1xuXG4gICAgfSBlbHNlIHtcbiAgICAgICAgLy8gSGFuZGxlIG9ubGluZSBmb3JtIHN1Ym1pc3Npb25cbiAgICAgICAgLy8gR2V0IGZvcm0gd2l0aCB0aGUgc2x1ZyBvbiByZXF1ZXN0XG4gICAgICAgIGZldGNoKCcvYWRtaW4vdXNlci9mb3JtLWpzb24vJyArIGZucy5zbHVnKS50aGVuKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICByZXR1cm4gZGF0YS5qc29uKCk7XG4gICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKGpzb25TdHJpbmcpIHtcbiAgICAgICAgICAgIC8vIFdlIGdldCBhbGwgdmFsdWVzIGZyb20gZHluZm9ybV92YWx1ZXMgdGFibGVcbiAgICAgICAgICAgIGxldCBqc29uRGF0YSA9IGpzb25TdHJpbmc7XG4gICAgICAgICAgICBsZXQgZm9ybVByb3BlcnRpZXMgPSBKU09OLnBhcnNlKGpzb25EYXRhLnByb3BlcnRpZXMpO1xuXG4gICAgICAgICAgICAvLyBSZW5kZXIgdGhlIGZvcm0sIHRoZW4gbGlzdGVuIGZvciBzdWJtaXQgYnRuIGNsaWNrXG4gICAgICAgICAgICBGb3JtaW8uY3JlYXRlRm9ybShkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZm9ybV9fdmlldycpLCBmb3JtUHJvcGVydGllcywge1xuICAgICAgICAgICAgICAgIHJlYWRPbmx5OiBmbnMucmVhZE9ubHlcbiAgICAgICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKGZvcm0pIHtcbiAgICAgICAgICAgICAgICBpZiAoZm5zLmVkaXRNb2RlKSB7XG4gICAgICAgICAgICAgICAgICAgIGZvcm0uc3VibWlzc2lvbiA9ICQoJyNmb3JtX192aWV3JykuZGF0YSgndmFsdWVzJyk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGZvcm0ub24oJ3N1Ym1pdCcsIChzdWJtaXNzaW9uKSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIHN1Ym1pc3Npb24uaWQgPSBqc29uRGF0YS5pZDtcbiAgICAgICAgICAgICAgICAgICAgc3VibWlzc2lvbi51cGRhdGVkX2F0ID0gZm5zLmdldFlNRCgpO1xuICAgICAgICAgICAgICAgICAgICAvLyBTdWJtaXQgYXMgbmV3IGRhdGEgaWYgbm90IGluIGVkaXQgbW9kZSwgZWxzZSB1cGRhdGUgdGhlIGV4aXN0aW5nIGRhdGFcbiAgICAgICAgICAgICAgICAgICAgZm5zLmVkaXRNb2RlID8gZm5zLnVwZGF0ZURhdGEoc3VibWlzc2lvbikgOiBmbnMuc3VibWl0RGF0YShzdWJtaXNzaW9uKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICBmb3JtLm9uKCdlcnJvcicsIChlcnJvcnMpID0+IHtcblxuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAgICAgZm9ybS5vbignY2hhbmdlJywgZnVuY3Rpb24gKGNoYW5nZSkge1xuICAgICAgICAgICAgICAgICAgICBpZiAod2luZG93LmlubmVyV2lkdGggPCA1MDApIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIC8vIFNldCBzbGljayBjbGFzcyB0byBkaXNwbGF5IG5vbmUgaWYgdGhlIGZvcm1pbyBjb21wb25lbnQgaXMgaGlkZGVuICYgdmljZSB2ZXJzYVxuICAgICAgICAgICAgICAgICAgICAgICAgJCgnLmZvcm0tZ3JvdXAnKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJCh0aGlzKS5hdHRyKCdoaWRkZW4nKSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkucGFyZW50KCkuYXR0cignc3R5bGUnLCAnZGlzcGxheTogbm9uZTsnKTtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLmF0dHIoJ3N0eWxlJywgJ2Rpc3BsYXk6IGJsb2NrOycpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICBmb3JtLm9uKCdyZW5kZXInLCAocmVuZGVyZWQpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAkKCcuZm9ybS0tc2xpZGVyJykuY2hpbGRyZW4oXCI6Zmlyc3RcIikuYWRkQ2xhc3MoJ21vYmlsZS0tc2xpZGVyJyk7XG4gICAgICAgICAgICAgICAgICAgICAgICBpZiAod2luZG93LmlubmVyV2lkdGggPCA1MDApIHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkKCcuZm9ybS0tc2xpZGVyIC5tb2JpbGUtLXNsaWRlcicpLnNsaWNrKHtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgYXJyb3dzOiB0cnVlXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAvLyBTZXQgc2xpY2sgY2xhc3MgdG8gZGlzcGxheSBub25lIGlmIHRoZSBmb3JtaW8gY29tcG9uZW50IGlzIGhpZGRlbiAmIHZpY2UgdmVyc2FcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAkKCcuZm9ybS1ncm91cCcpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiAoJCh0aGlzKS5hdHRyKCdoaWRkZW4nKSAhPT0gdW5kZWZpbmVkKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLmF0dHIoJ3N0eWxlJywgJ2Rpc3BsYXk6IG5vbmU7Jyk7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLmF0dHIoJ3N0eWxlJywgJ2Rpc3BsYXk6IGJsb2NrOycpO1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgIH0sIDEwMDApXG5cbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgIH0pO1xuICAgICAgICAvLyBTeW5jIHRvIGxpdmVcbiAgICAgICAgLy8gUmVxdWVzdCB3ZWIgd29ya2VyIHRvIHN5bmMgZGF0YSB0byBsaXZlIGRiXG4gICAgICAgIHdvcmtlci5wb3N0TWVzc2FnZShbJ3N5bmNUb0xpdmUnLCBmbnMudG9rZW5dKTtcblxuICAgICAgICAvLyBTeW5jIGZvcm1zIGZyb20gbGl2ZSB0byBsb2NhbFxuICAgICAgICB3b3JrZXIucG9zdE1lc3NhZ2UoWydzeW5jRm9ybXMnXSk7XG4gICAgfVxuXG4gICAgLy8gUmVjZWl2ZSBtZXNzYWdlcyBmcm9tIHdlYiB3b3JrZXJcbiAgICB3b3JrZXIuYWRkRXZlbnRMaXN0ZW5lcignbWVzc2FnZScsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgIGxldCByZXNwID0gZS5kYXRhO1xuICAgICAgICBpZiAocmVzcC50eXBlID09PSBcInN0b3JlSW5Mb2NhbFwiKSB7XG4gICAgICAgICAgICAvLyBJZiBzdG9yZSBzdWNjZXNzZnVsXG4gICAgICAgICAgICBpZiAocmVzcC5zdGF0dXMpIHtcbiAgICAgICAgICAgICAgICAkKCcuZ2x5cGhpY29uLXJlZnJlc2guZ2x5cGhpY29uLXNwaW4nKS5yZW1vdmUoKTtcbiAgICAgICAgICAgICAgICAkKCdbbmFtZT1cImRhdGFbc3VibWl0XVwiXScpLmF0dHIoJ2NsYXNzJywgJ2J0biBidG4tcHJpbWFyeSBidG4tbWQgYnRuLXN1Y2Nlc3Mgc3VibWl0LXN1Y2Nlc3MnKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgJCgnLmdseXBoaWNvbi1yZWZyZXNoLmdseXBoaWNvbi1zcGluJykucmVtb3ZlKCk7XG4gICAgICAgICAgICAgICAgJCgnW25hbWU9XCJkYXRhW3N1Ym1pdF1cIl0nKS5hdHRyKCdjbGFzcycsICdidG4gYnRuLXByaW1hcnkgYnRuLW1kIGJ0bi1kYW5nZXIgc3VibWl0LWZhaWwnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIGlmIChyZXNwLnR5cGUgPT09IFwic3luY1RvTGl2ZVwiKSB7XG4gICAgICAgICAgICBjb25zb2xlLmxvZyhyZXNwLnN0YXR1cyk7XG4gICAgICAgIH0gZWxzZSBpZiAocmVzcC50eXBlID09PSBcImdldEZvcm1cIikge1xuICAgICAgICAgICAgbGV0IGl0ZW0gPSByZXNwLmRhdGE7XG4gICAgICAgICAgICAvLyBTZXQgdGl0bGUgb2YgdGhlIGZvcm0gcGFnZVxuICAgICAgICAgICAgJCgnI2Zvcm0tdGl0bGUnKS5odG1sKGl0ZW0udGl0bGUpO1xuICAgICAgICAgICAgLy8gUmVuZGVyIHRoZSBmb3JtXG4gICAgICAgICAgICBGb3JtaW8uY3JlYXRlRm9ybShkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZm9ybV9fdmlldycpLCBKU09OLnBhcnNlKGl0ZW0ucHJvcGVydGllcykpLnRoZW4oZnVuY3Rpb24gKGZvcm0pIHtcbiAgICAgICAgICAgICAgICBmb3JtLm9uKCdzdWJtaXQnLCAoc3VibWlzc2lvbikgPT4ge1xuICAgICAgICAgICAgICAgICAgICBzdWJtaXNzaW9uLmZvcm1JZCA9IGl0ZW0uaWQ7XG4gICAgICAgICAgICAgICAgICAgIHN1Ym1pc3Npb24udXBkYXRlZF9hdCA9IGZucy5nZXRZTUQoKTtcbiAgICAgICAgICAgICAgICAgICAgLy8gUmVxdWVzdCB3ZWIgd29ya2VyIHRvIGFkZCBkYXRhIHRvIGxvY2FsIGRiXG4gICAgICAgICAgICAgICAgICAgIHdvcmtlci5wb3N0TWVzc2FnZShbJ3N0b3JlSW5Mb2NhbCcsIHN1Ym1pc3Npb25dKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICBmb3JtLm9uKCdlcnJvcicsIChlcnJvcnMpID0+IHtcblxuICAgICAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0gZWxzZSBpZiAocmVzcC50eXBlID09PSBcImdldEFsbEZvcm1zXCIpIHtcbiAgICAgICAgICAgIGxldCBtZW51cyA9IHJlc3AuZGF0YTtcbiAgICAgICAgICAgIGxldCBsZWZ0TWVudSA9IGZucy5nZXRMZWZ0TWVudShtZW51cyk7XG4gICAgICAgICAgICAkKCcjdGhlTWVudScpLmh0bWwobGVmdE1lbnUpO1xuICAgICAgICB9XG4gICAgfSk7XG59KTtcblxuY29uc3QgZm5zID0ge1xuICAgIHNsdWc6ICcnLFxuICAgIHRva2VuOiAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpLFxuICAgIHJlYWRPbmx5TW9kZTogZmFsc2UsXG4gICAgZWRpdE1vZGU6IGZhbHNlLFxuICAgIG9wdGlvbnM6IHtcbiAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgXCJDb250ZW50LVR5cGVcIjogXCJhcHBsaWNhdGlvbi9qc29uXCIsXG4gICAgICAgICAgICBcIkFjY2VwdFwiOiBcImFwcGxpY2F0aW9uL2pzb24sIHRleHQtcGxhaW4sICovKlwiLFxuICAgICAgICAgICAgXCJYLVJlcXVlc3RlZC1XaXRoXCI6IFwiWE1MSHR0cFJlcXVlc3RcIixcbiAgICAgICAgICAgIFwiWC1DU1JGLVRPS0VOXCI6ICcnXG4gICAgICAgIH0sXG4gICAgICAgIG1ldGhvZDogJ3Bvc3QnLFxuICAgICAgICBjcmVkZW50aWFsczogXCJzYW1lLW9yaWdpblwiLFxuICAgIH0sXG4gICAgaW5pdDogKCkgPT4ge1xuICAgICAgICAvLyBTZXQgdG9rZW4gaW4gb3B0aW9ucycgaGVhZGVyXG4gICAgICAgIGZucy5vcHRpb25zLmhlYWRlcnNbJ1gtQ1NSRi1UT0tFTiddID0gZm5zLnRva2VuO1xuICAgICAgICAvLyBTZXQgbW9kZXMgZm9yIGZvcm0gaWYgaXQncyByZWFkb25seSAvIGVkaXRhYmxlIC8gbmV3IGZvcm0gZXRjLlxuICAgICAgICBmbnMuc2V0Rm9ybU1vZGUoKTtcbiAgICAgICAgcmV0dXJuIG5ldyBXb3JrZXIoJy9hc3NldHMvd2Vic2l0ZS9qcy93b3JrZXIuanMnKTtcbiAgICB9LFxuICAgIHNldEZvcm1Nb2RlOiAoKSA9PiB7XG4gICAgICAgIGxldCBmaWVsZCA9ICQoJyNmb3JtX192aWV3JykuZGF0YSgnbW9kZScpO1xuICAgICAgICBpZiAodHlwZW9mIGZpZWxkICE9PSAndW5kZWZpbmVkJykge1xuICAgICAgICAgICAgZm5zLnJlYWRPbmx5ID0gZmllbGQgPT09IFwicmVhZG9ubHlcIjtcbiAgICAgICAgICAgIGZucy5lZGl0TW9kZSA9IGZpZWxkID09PSBcImVkaXRcIjtcbiAgICAgICAgfVxuICAgIH0sXG4gICAgc3VibWl0RGF0YTogKGRhdGEpID0+IHtcbiAgICAgICAgZm5zLm9wdGlvbnMuYm9keSA9IEpTT04uc3RyaW5naWZ5KGRhdGEpO1xuICAgICAgICAvLyBTdWJtaXQgdGhlIGZvcm0gdmlhIEFQSVxuICAgICAgICBmZXRjaCgnL2FwaS9mb3Jtcy9zdWJtaXQnLCBmbnMub3B0aW9ucykudGhlbihmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgLy8gU2V0IHN1Ym1pdCBidXR0b24gYXMgZm9ybSBzdWJtaXR0ZWRcbiAgICAgICAgICAgICQoJy5nbHlwaGljb24tcmVmcmVzaC5nbHlwaGljb24tc3BpbicpLnJlbW92ZSgpO1xuICAgICAgICAgICAgJCgnW25hbWU9XCJkYXRhW3N1Ym1pdF1cIl0nKS5hdHRyKCdjbGFzcycsICdidG4gYnRuLXByaW1hcnkgYnRuLW1kIGJ0bi1zdWNjZXNzIHN1Ym1pdC1zdWNjZXNzJyk7XG5cbiAgICAgICAgICAgIGNvbnNvbGUubG9nKGRhdGEpO1xuICAgICAgICB9KTtcbiAgICB9LFxuICAgIHVwZGF0ZURhdGE6IChkYXRhKSA9PiB7XG4gICAgICAgIGRhdGEudXBkYXRlX2lkID0gJCgnI2Zvcm1fX3ZpZXcnKS5kYXRhKCdpZCcpO1xuICAgICAgICBmbnMub3B0aW9ucy5ib2R5ID0gSlNPTi5zdHJpbmdpZnkoZGF0YSk7XG4gICAgICAgIC8vIFN1Ym1pdCB0aGUgZm9ybSB2aWEgQVBJXG4gICAgICAgIGZldGNoKCcvYXBpL2Zvcm1zL3VwZGF0ZScsIGZucy5vcHRpb25zKS50aGVuKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAvLyBTZXQgc3VibWl0IGJ1dHRvbiBhcyBmb3JtIHN1Ym1pdHRlZFxuICAgICAgICAgICAgJCgnLmdseXBoaWNvbi1yZWZyZXNoLmdseXBoaWNvbi1zcGluJykucmVtb3ZlKCk7XG4gICAgICAgICAgICAkKCdbbmFtZT1cImRhdGFbc3VibWl0XVwiXScpLmF0dHIoJ2NsYXNzJywgJ2J0biBidG4tcHJpbWFyeSBidG4tbWQgYnRuLXN1Y2Nlc3Mgc3VibWl0LXN1Y2Nlc3MnKTtcbiAgICAgICAgfSk7XG4gICAgfSxcbiAgICBnZXRTbHVnOiAoKSA9PiB7XG4gICAgICAgIGZucy5zbHVnID0gJCgnI2Zvcm1fX3ZpZXcnKS5kYXRhKCdzbHVnJyk7XG4gICAgfSxcbiAgICBnZXRPZmZsaW5lU2x1ZzogKCkgPT4ge1xuICAgICAgICBsZXQgdXJsID0gd2luZG93LmxvY2F0aW9uLmhyZWY7XG4gICAgICAgIGxldCB1cmxBcnJheSA9IHVybC5zcGxpdChcIi9cIik7XG4gICAgICAgIGZucy5zbHVnID0gdXJsQXJyYXlbdXJsQXJyYXkubGVuZ3RoIC0gMV07XG4gICAgfSxcbiAgICBnZXRZTUQ6ICgpID0+IHtcbiAgICAgICAgbGV0IGRhdGVPYmogPSBuZXcgRGF0ZSgpO1xuICAgICAgICBsZXQgbW9udGggPSBkYXRlT2JqLmdldFVUQ01vbnRoKCkgKyAxOyAvL21vbnRocyBmcm9tIDEtMTJcbiAgICAgICAgbGV0IGRheSA9IGRhdGVPYmouZ2V0VVRDRGF0ZSgpO1xuICAgICAgICBsZXQgeWVhciA9IGRhdGVPYmouZ2V0VVRDRnVsbFllYXIoKTtcbiAgICAgICAgbGV0IHRpbWUgPSBkYXRlT2JqLmdldEhvdXJzKCkgKyBcIjpcIiArIGRhdGVPYmouZ2V0TWludXRlcygpICsgXCI6XCIgKyBkYXRlT2JqLmdldFNlY29uZHMoKTtcblxuICAgICAgICByZXR1cm4gKHllYXIgKyBcIi1cIiArIG1vbnRoICsgXCItXCIgKyBkYXkgKyBcIiBcIiArIHRpbWUpO1xuICAgIH0sXG4gICAgZ2V0TGVmdE1lbnU6IChtZW51cykgPT4ge1xuICAgICAgICBsZXQgZWwgPSAnJztcbiAgICAgICAgbWVudXMuZm9yRWFjaCgobWVudSkgPT4ge1xuICAgICAgICAgICAgZWwgKz0gJzxkaXYgY2xhc3M9XCJpdGVtLXRvb2x0aXBcIj4nICtcbiAgICAgICAgICAgICAgICAnICAgICAgICAgICAgPGxpIGNsYXNzPVwiaXRlbVwiPicgK1xuICAgICAgICAgICAgICAgICcgICAgICAgICAgICAgICAgPGEgaHJlZj1cImphdmFzY3JpcHQ6dm9pZCgwKVwiPjxpIGNsYXNzPVwiaWNvbiBmYSBmYS1ob21lXCIgYXJpYS1oaWRkZW49XCJ0cnVlXCI+PC9pPjwvYT4nICtcbiAgICAgICAgICAgICAgICAnICAgICAgICAgICAgICAgIDxzcGFuIGNsYXNzPVwiYnRuLWNsYXNzXCI+JyArXG4gICAgICAgICAgICAgICAgJyAgICAgICAgICAgICAgICAgICAgICAgIDxhIGNsYXNzPVwibWVudV9pdGVtXCIgaHJlZj1cIi9hZG1pbi9mb3Jtcy8nICsgbWVudS5pZCArICdcIj4nICsgbWVudS50aXRsZSArICc8L2E+JyArXG4gICAgICAgICAgICAgICAgJyAgICAgICAgICAgICAgICAgICAgPC9zcGFuPicgK1xuICAgICAgICAgICAgICAgICcgICAgICAgICAgICA8L2xpPicgK1xuICAgICAgICAgICAgICAgICcgICAgICAgICAgICA8c3BhbiBjbGFzcz1cInRvb2x0aXB0ZXh0IHRvb2x0aXAtcmlnaHRcIj4nICsgbWVudS50aXRsZSArICc8L3NwYW4+JyArXG4gICAgICAgICAgICAgICAgJyAgICAgICAgPC9kaXY+JztcbiAgICAgICAgfSk7XG4gICAgICAgIHJldHVybiBlbDtcbiAgICB9XG59O1xuIl19
},{}]},{},[1])