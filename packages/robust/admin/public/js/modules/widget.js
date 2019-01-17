;
(function ($, FRW, window, document, undefined) {
    'use strict';

    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Widget = {
        init: function () {
            this.obj = $('.widget-content');
            this.obj.each(function (index) {
                FRW.Widget.pollServer(this);
            });
        },
        pollServer: function (obj) {
            var $url = $('.widget-container').data('url');
            var $type = $('.widget-container').data('type');
            var $data = {type: $type, date_range: {value: 'this week'}};
            $.ajax({
                url: $url,
                data: $data,
                success: function ($result) {
                    $(obj).find('.widget__widget-count').html($result.count);
                    $(obj).find('.widget__widget-percentage-up').text($result.percentage_up);
                }
            });
        }

    };
    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        FRW.Widget.init();
    });

}(jQuery, FRW, window, document));