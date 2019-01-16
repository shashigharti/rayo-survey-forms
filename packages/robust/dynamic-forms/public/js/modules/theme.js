;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
        $('#theme a').click(function () {
            var cls = $(this).data('class');
            var url = $(this).data('url');
            var message_handler = $('#message_handler');

            $('#theme_preview').attr('class', '');
            $('#theme_preview').addClass(cls);

            console.log(url);
            $.ajax({
                method: "POST",
                url: url,
                data: {cls: cls},
                async: true,
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    console.log(result);
                    message_handler.html(
                        '<div class="animated rotateIn alert alert-success">' +
                        '<strong> ' + result + ' </strong>' +
                        '</div> '
                    );
                    $('.alert').fadeOut(3000, "linear");
                }
            });
        });
    });

}(jQuery, FRW, window, document));