;
( function( $, FRW, window, document, undefined ) {
    "use strict"
    FRW.Auth = {
        init: function() {
            const AUTH_FORM = $('.auth--form');
            AUTH_FORM.on('submit',function (e) {
                const URL = $(this).data('url');
                e.preventDefault();
                const DATA = $(this).serialize();
                const info = $(this).find('.msg-info');
                const error = $(this).find('.msg-error');
                info.html('');
                error.html('');
                $.ajax({
                    url:URL,
                    type:"POST",
                    data:DATA,
                    success:function (response) {
                        info.html(response.message);
                        setTimeout(location.reload.bind(location), 2000);
                    },
                    error:function (response) {
                        const errors = response.responseJSON.errors;
                        let msg = '';
                        if (Object.keys(errors).length > 0){
                            $.each(errors, function(key, error) {
                                $.each(error,function (key,value) {
                                    msg += value;
                                })
                            });
                        }
                        error.html(msg);
                    }
                })
            });
        }
    };

    $( function() {
        FRW.Auth.init();
    } );
}( jQuery, FRW, window, document ) );
