;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DateConverter = {
        init: function (editors) {
            $('.convert-date-nepali').on('change',function () {
                const id = $(this).data('converted');
                const elem = $(`#${id}`);
                const input = elem.is('input');
                const value = $(this).val();
                if(value === ''){
                    if(input){
                        elem.val(value);
                    }else{
                        elem.html(value);
                    }
                }else{
                    const data = new FormData();
                    const date = value.split("-");
                    if(date.length === 3){
                        data.append('year',date[0])
                        data.append('month',date[1])
                        data.append('day',date[2])
                        $.ajax({
                            data: data,
                            url: '/api/date/convert/nepali',
                            method: "POST",
                            cache: false,
                            contentType: false,
                            processData: false
                        }).done(function (response) {
                            const converted = response.date;
                            const date = `${converted.y}-${converted.m}-${converted.d}`;
                            if(input){
                                elem.val(date);
                            }else{
                                elem.html(date);
                            }
                        });
                    }
                }
            });

        }
    };

    $(document).ready(function ($) {
        let elements = document.querySelectorAll('.convert-date-nepali');
        M.Datepicker.init(elements,{
            format: 'yyyy-mm-dd',
            autoClose:true
        });
        FRW.DateConverter.init();
    });

}(jQuery, FRW, window, document));
