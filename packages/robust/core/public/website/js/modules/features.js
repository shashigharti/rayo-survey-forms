;
( function( $, FRW, window, document, undefined ) {
    "use strict"
    FRW.Features = {
        init: function() {
            const features = $('.advance-search_features');
            features.each(function() {
                const feature = $(this);
                const URL = feature.data('url');
                $.get(URL).then(response => {
                    const options = response.data;
                    options.map(function (option) {
                        const child = `<option value="${option.id}">${option.name}</option>`;
                        feature.append(child);
                    });
                });
            });
        }
    };

    $( function() {
        FRW.Features.init();
    } );
}( jQuery, FRW, window, document ) );
