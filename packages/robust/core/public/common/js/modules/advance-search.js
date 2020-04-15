;
(function ($, FRW, window, document, undefined) {
    "use strict"

    function submit(url=null) {
        if(!url){
            url = $('#frm-search').attr('action');
        }
        let qParams = $('#frm-search').serialize();
        qParams = (qParams == '') ? '' : '?' + qParams;
        window.location.replace(url + qParams);
    }

    function getParams() {
        let response = {}, queries = [], url;
        url = window.location.search.substring(1);
        if (url != '') {
            // Split into key/value pairs
            queries = url.split("&");
        }

        // Convert the array of strings into an object
        $.each(queries, function (index, value) {
            let params = decodeURIComponent(value).split('='), isArray;
            let key = params[0].replace(/[\[\]']+/g, '');
            let param_value = params[1];
            isArray = /[\[\]']+/g.test(params[0]);

            if (param_value != '') {
                // For single value form params
                if (!isArray) {
                    response[key] = param_value;
                } else {
                    if (!response[key]) {
                        response[key] = [];
                    }
                    response[key].push(param_value);
                }
            }

        });

        return response;
    }

    function renderTags(params) {
        let tagContainer = $('.search-section__tags'), template = [];

        $.each(params, function (key, value) {
            if (value != '') {
                if (Array.isArray(value)) {
                    $.each(value, function (k, v) {
                        template.push(`<span class="chip" data-key="${key}" data-value="${v}"> ${key} : ${v} <i class="close material-icons">close</i></span>`);
                    });
                } else {
                    template.push(`<span class="chip" data-key="${key}" data-value="${value}"> ${key} : ${value} <i class="close material-icons">close</i></span>`);
                }

            }
        });

        if (template.length > 0) {
            tagContainer.html(template);
            $('.search-section__tags-action').show();
        } else {
            $('.search-section__tags-action').hide();
        }

    }

    $(function () {
        let advSearchElem = $('.advance-search');
        let searchSection = $('#search-section');

        // Check if it has advance search
        if (advSearchElem.length > 0) {
            let inputElements = [];
            advSearchElem.click(function (e) {

                e.preventDefault();
                $('#adv-search-dropdown').toggleClass('show');
                $('#adv-search-dropdown .advance-search__save').data('search-save-url',$(this).data('search-save-url'));
            });

            inputElements = $('[data-selected]:not(.multi-select)');
            $.each(inputElements, (index, elem) => {
                // Set the selected value for all those elements who are not of class multi-select
                elem.value = $(elem).attr('data-selected');
            });
        }

        // Check if it has search form
        // Set search params on value change
        if (searchSection.length > 0) {
            let params = {}, qParams;

            // Load params using form field if they are set on load
            params = getParams();
            renderTags(params);

            $('.chip').on('click', function (e) {
                let key = $(this).data('key'), value = $(this).data('value'), value_index;
                let values = params[key];

                if (Array.isArray(params[key])) {
                    value_index = params[key].indexOf(value);
                    params[key].splice(value_index, 1);
                    if (params[key].length <= 0) {
                        delete params[key];
                    }
                } else {
                    delete params[key];
                }
                qParams = (qParams == '') ? '' : '?' + $.param(params);
                window.location.search = qParams;
            });

            // Set sort value to sort_by field in advance search form
            $('.search-section__select').on('change', function () {
                $('#frm-search').find('[name="sort_by"]').val($(this).val());
            });

            const sliders = searchSection.find('.jrange-slider');
            $.each(sliders, (index, elem) => {
                let [scale_min, scale_max, format] = [
                    $(elem).attr('data-scale-min'),
                    $(elem).attr('data-scale-max'),
                    $(elem).attr('data-format') || "%s"
                ];

                // temporarily using jquery $ object and jquery library
                $(elem).jRange({
                    from: $(elem).attr('data-min'),
                    to: $(elem).attr('data-max'),
                    step: $(elem).attr('data-step') || 1,
                    scale: [scale_min, scale_max],
                    format,
                    width: 150,
                    isRange: true,
                });

                $(elem).on('change', function () {
                    let [min, max, name] = [
                        $(this).val().split(",")[0],
                        $(this).val().split(",")[1],
                        $(this).attr("name")
                    ];
                    let [min_name, max_name] = [name + '_min', name + '_max'];
                    $("#adv-search-dropdown [name='" + min_name + "']>option[value='" + min + "']").attr('selected', true);
                    $("#adv-search-dropdown [name='" + max_name + "']>option[value='" + max + "']").attr('selected', true);
                    $("#adv-search-dropdown [name='" + min_name + "']").formSelect();
                    $("#adv-search-dropdown [name='" + max_name + "']").formSelect();

                    if (!params[min_name]) {
                        params[max_name] = 0;
                    }
                    if (!params[max_name]) {
                        params[max_name] = 0;
                    }
                    params[min_name] = min;
                    params[max_name] = max;
                });
            });


            // On search button click
            $('#frm-search').on('submit', (e) => {
                e.preventDefault();
                submit();
            });
            // On search button click
            $('#search-btn').on('click', (e) => {
                e.preventDefault();
                submit();
            });

            // Set params value on advance search fields value change
            $('.ad-search-field').on('change', function (e) {
                let prop = $(this).attr('name');
                prop = prop.replace(/[\[\]']+/g, '');
                if (!params[prop]) {
                    params[prop] = 0;
                }
                params[prop] = $(this).val();
            });
        }
        $('.advance-search__save').on('click',function (e) {
            e.preventDefault();
            submit($(this).data('search-save-url'));
        });
    });
}(jQuery, FRW, window, document));
