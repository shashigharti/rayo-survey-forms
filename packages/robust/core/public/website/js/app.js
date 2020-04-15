//import("modules/materialize.min.js")
//import("modules/modal.js")
//import("modules/social.js")
//import("../../common/js/modules/multi-select.js")
//import("modules/load-google-maps.js")
//import("modules/main.js")
//import("modules/auth.js")
//import("modules/dropdown.js")
//import("modules/features.js")
//import("modules/jquery.range.js")
//import("modules/search.js")

// Global Map loading for RealEstate and make it global
$(function () {
    let key = $('body').data('gapi-key');
    $.when(loadGoogleMaps(3, key, 'en', false, ['geometry', 'places']))
        .then(function () { // or .done(...)
            !!google.maps // true

            // Trigger Map Loaded Event
            $(document).trigger("map-loaded");

            // Initialize auto complete
            function autoCompleteInitialization() {
                let autoCompleteElem = new google.maps.places.Autocomplete(document.getElementById('autocomplete_address'));
                $(document).trigger("auto-complete-loaded", [autoCompleteElem]);
            }
            google.maps.event.addDomListener(window, 'load', autoCompleteInitialization);
        });

});


