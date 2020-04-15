;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.IconUploader = {
        init: function(){
            $('.icon_file-uploader').on('change',function (e) {
                console.log($(this));
                const url = $(this).data('url');
                const data = new FormData();
                $.each($(this)[0].files, function (i, file) {
                    data.append('file-' + i, file);
                });
                const media = $(e.target).parent().parent().find('.icon_media-id');
                $.ajax({
                    data: data,
                    url: url,
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function (response) {
                    media.val(response.data.media_ids);
                });
            });
        },
    }
    $(document).ready(function ($) {
        if ($('.icon_file-uploader').length > 0){
            FRW.IconUploader.init();
        }
    });
}(jQuery, FRW, window, document));
