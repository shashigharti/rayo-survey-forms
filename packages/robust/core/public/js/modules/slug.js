;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {

        $(".name").change(function () {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^\w ]+/g, '');
            Text = Text.replace(/ +/g, '-')
            $(".slug").val(Text);
        });
    });
}(jQuery, FRW, window, document));
