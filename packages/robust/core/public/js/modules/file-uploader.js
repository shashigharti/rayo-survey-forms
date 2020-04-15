;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.FileUploader = {
        init: function () {
            $('.file-uploader .file-uploader__input').filer();
            let uploader = $('.file-uploader'),
                dest = uploader.data('dest'),
                store_url = uploader.data("upload-path"),
                delete_url = uploader.data("base-path");

            $('.file-uploader__upload-btn').on('click', function () {
                let data = new FormData();

                $.each($('.file-uploader .file-uploader__input')[0].files, function (i, file) {
                    data.append('file-' + i, file);
                });
                $('.file_uploader_progress').removeClass('hide');
                $.ajax({
                    data: data,
                    url: store_url,
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function (response) {

                    let medias = JSON.parse(response.data.medias);
                    $(dest).val(response.data.media_ids);
                    $('.file-uploader .file-uploader__input').val('');
                    $.each(medias, function (index, media) {
                        let template = `
                            <div data-id="${media.id}" class="file-uploader__file">
                                <img height="80" src="${media.url}"/>
                                <a href="javascript:void(0)" class="file-uploader__delete-btn"> <i class="material-icons"> delete </i> </a>
                            </div>
                        `;
                        $('.file-uploader .file-uploader__preview').append(template);
                    });
                    FRW.FileUploader.updateField();
                    $('.file_uploader_progress').addClass('hide');
                });

            });
            $(document.body).on('click', '.file-uploader__delete-btn', function () {
                let id = $(this).parent().data('id'),
                    _token = $("input[name='_token']").val(),
                    parent = $(this).parent().parent();
                $.ajax({
                    url: delete_url,
                    data: {id: id, _token: _token, _method: "DELETE"},
                    method: "POST"
                }).done(function (response) {
                    if (response.data.status == "success"){
                        parent.html('');
                        FRW.FileUploader.updateField();
                    }
                });
            });
            $('.file-uploader .file-uploader__input').prop('jFiler').reset();
        },
        updateField: function () {
            let uploader = $('.file-uploader'),
                dest = uploader.data('dest');

            let ids = [],
                images = $('.file-uploader__file');

            $.each(images, function (index, image) {
                ids.push($(image).data('id'));
            });

            if (ids.length > 0) {
                ids = ids.join();
            }
            $(dest).val(ids);
        }
    };

    $(document).ready(function ($) {

        let file_uploader = $('.file-uploader .file-uploader__input');
        if (file_uploader.length <= 0) {
            return;
        }

        FRW.FileUploader.init();
    });

}(jQuery, FRW, window, document));
