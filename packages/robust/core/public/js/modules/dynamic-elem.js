;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DynamicElem = {
        init: function () {
            $(document.body).on('click', '.dynamic-elem__add', function () {
                let container = $(this).parent().parent(), parent = container.parent(),
                    newElem = container.clone(),
                    key = container.data('key');

                newElem.find(':input').each(function (index, elem) {
                    let name = $(elem).attr('name'),
                        id = $(elem).attr('id');
                    $(elem).attr('name', name.replace(key, key + 1));
                    if (id) {
                        $(elem).attr('id', id.replace(key, key + 1));
                    }

                });
                newElem.find('label').each(function (index, elem) {
                    let _for = $(elem).attr('for');
                    if (_for) {
                        $(elem).attr('for', _for.replace(key, key + 1));
                    }
                });
                newElem.attr('data-key', key + 1);
                newElem.appendTo(parent);
                container.find('.dynamic-elem__add').toggleClass('hide');
            });
            $(document.body).on('click', '.dynamic-elem__delete', function () {
                let prev_elem = $(this).parent().parent().prev(),
                    next_elem = $(this).parent().parent().next(),
                    hasNext = false;


                $(this).parent().parent().remove();
                if (next_elem) {
                    hasNext = next_elem.hasClass("row dynamic-elem");
                    console.log(next_elem.hasClass("row dynamic-elem"));
                }
                if (!hasNext) {
                    prev_elem.find('.dynamic-elem__add').toggleClass('hide');
                }

            });
        }
    };

    $(document).ready(function ($) {
        let selectObj = $('.dynamic-elem');
        if (selectObj.length <= 0) {
            return;
        }
        console.log("Dynamic Element");

        FRW.DynamicElem.init();
    });

}(jQuery, FRW, window, document));
