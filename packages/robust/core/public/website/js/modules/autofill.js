;
( function( $, FRW, window, document, undefined ) {
    "use strict"
    FRW.AutoFill = {
        init: function() {
            $( ".autofill" ).on( "change", function() {
                let $url = $( this ).data( "url" );
                let $dest = $( this ).data( "dest" );
                let $value = $( this ).data( "value-field" );
                let $display = $( this ).data( "display-field" );
                let $formId = $( this ).val();

                $.ajax( {
                    url: $url,
                    data: { formId: $formId }
                } )
                    .done( function( $response ) {
                        $( $dest ).empty();
                        $.each( $response.data, function( key, value ) {
                            $( "<option>", {
                                value: value[$value],
                                text: value[$display]
                            } ).appendTo( $dest );
                        } );
                    } );
            } );
        }
    };
    $( function() {
        FRW.AutoFill.init();
    } );
}( jQuery, FRW, window, document ) );
