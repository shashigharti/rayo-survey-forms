;
( function( $, FRW, window, document, undefined ) {
    "use strict";

    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Forms = {};
    FRW.Forms.Address = {

        startup: true,
        init: function( obj ) {
            var geocoder = new google.maps.Geocoder;

            $( ".address__container :input" ).on( "change", function( e ) {
                var address = "";
                $.each( $( ".address__container :input" ), function( ind, add ) {
                    if ( ind != 2 ) {
                        address += " " + $( add ).val();
                    }
                } );
                if ( $.trim( address ) !== "" ) {
                    geocoder.geocode( { "address": address }, function( results, status ) {
                        if ( status === "OK" ) {
                            var lat_lng = $( ".address__container input:hidden" );
                            $( lat_lng[ 0 ] ).val( results[ 0 ].geometry.location.lat() );
                            $( lat_lng[ 1 ] ).val( results[ 0 ].geometry.location.lng() );
                        }
                    } );
                }
            } );

        }
    };
    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $( function() {
        FRW.Forms.Address.init();

    } );

}( jQuery, FRW, window, document ) );
