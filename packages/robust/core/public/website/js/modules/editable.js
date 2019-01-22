;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Editable = {
        init: function($obj){
            $(document).on('click', $obj, function(){
                $(this).editable('dblclick',function(e){
                    if($.trim(e.value) == ''){
                        $(this).html(e.old_value);
                    }
                });
            });            
        }
    }
}(jQuery, FRW, window, document));
