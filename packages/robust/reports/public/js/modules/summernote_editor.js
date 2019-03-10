;
(function ($, FRW, window, document, undefined) {
    'use strict';

    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Reports.SummerNoteEditor = {
        init: function ($obj) {
            $($obj).summernote({
                airMode: true,
                callbacks: {
                    onChange: function(contents, $editable) {
                        $($obj).trigger('change');
                    }
                }
            });
        }

    };

}(jQuery, FRW, window, document));