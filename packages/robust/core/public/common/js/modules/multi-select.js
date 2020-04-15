;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Select = {
        init: function () {
            const elements = $('.multi-select');

            if (elements.length > 0) {
                elements.each((index, elem) => {
                    const URL = $(elem).data('url'),
                        dest = $(elem).data('dest');
                    let selectedElements = [];

                    // if it has properties data-selected read the values
                    if ($(elem).data('selected')) {
                        selectedElements = $(elem).data('selected').toString().split(",");
                    }

                    // Add onchange event
                    if (dest) {
                        $(elem).on('change', FRW.Select.onChange);
                    }

                    // get data from remote server when url is set
                    if (URL) {
                        $.get(URL).then(response => {
                            const options = response.data;
                            if (options) {
                                options.forEach(option => {
                                    let inArray = -1;
                                    let child = '';
                                    let selected = '';

                                    if (selectedElements.length > 0) {
                                        inArray = selectedElements.findIndex(selectedElem => (selectedElem === option.name) || (selectedElem === option.slug));
                                        if (inArray >= 0) {
                                            selected = 'selected';
                                            selectedElements.splice(inArray, 1)
                                        }

                                    }

                                    child = `<option value="${option.slug || option.name}" ${selected} >${option.name}</option>`;
                                    $(elem).append(child);
                                });
                            }
                            selectedElements.forEach(option => {
                                let child = `<option value="${option}" selected>${option}</option>`;
                                $(elem).append(child);
                            });

                        });
                    }else{
                        selectedElements.forEach(option => {
                            let child = `<option value="${option}" selected>${option}</option>`;
                            $(elem).append(child);
                        });
                    }
                });
            }
        },
        onChange: function (e) {
            let dest = $(this).data('dest'),
                url = $(this).data('dest-url'),
                elem = $(dest);
            url = url.replace(/param/gi, $(this).val());
            if (dest !== '') {
                $.get(url).then(response => {
                    $(elem).html('');
                    const options = response.data;
                    if (options) {
                        options.forEach(option => {
                            let child = `<option value="${option.slug || option.name}">${option.name}</option>`;
                            $(elem).append(child);
                        });
                    }
                });
            }
        }
    };

    $(document).ready(function ($) {
        let $elem = $(".multi-select");
        $elem.select2({
            tags: $elem.data('tags')
        });
        FRW.Select.init();
    });

}(jQuery, FRW, window, document));
