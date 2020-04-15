;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.TestEmail = {
        init: function (selectObj) {
            selectObj.on('click', function (e) {
                e.preventDefault();
                $('.test-email_result').html(`Processing
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>`);
                let url = $(this).data('url');
                const value = $('#test_email').val();
                url = url + '?email=' + value;
                $.get(url).then(response => {
                   $('.test-email_result').html(response);
                });
            });
        }
    };

    $(document).ready(function ($) {
        let selectObj = $('.test-email__send');
        if (selectObj.length <= 0) {
            return;
        }

        FRW.TestEmail.init(selectObj);
    });


}(jQuery, FRW, window, document));
