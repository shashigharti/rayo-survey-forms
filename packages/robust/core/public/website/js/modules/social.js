;
(function ($, FRW, window, document, undefined) {
    'use strict';

    FRW.SocialShare = {
        config: {
            width: 500,
            height: 500
        },

        init: function () {
            $('.social_services').on('click', '.social__link', function (e) {
                var px = Math.floor(((screen.availWidth || 1024) - FRW.SocialShare.config.width) / 2),
                    py = Math.floor(((screen.availHeight || 700) - FRW.SocialShare.config.height) / 2);

                var popup = window.open(
                    $(this).attr('href'),
                    "social",
                    "width=" + FRW.SocialShare.config.width + ",height=" + FRW.SocialShare.config.height + ",left=" + px + ",top=" + py + ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1"
                ).focus();

                return false;
            });
        }
    };

    $(function () {
        FRW.SocialShare.init();
    })

}(jQuery, FRW, window, document));
