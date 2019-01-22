;
(function ($, FRW, window, document, undefined) {
    'use strict';

    FRW.MediaManager = {
        selected: [],
        multiple: false,
        media_div: '',
        selected_models: [],
        media_path: '',
        field_name: '',

        init: function () {
            $('.modal-media_upload_form').submit(false);

            $('body').on('click', '.media-upload_button', this.openUploader);
            $('body').on('change', '#fileupload', this.uploadMedia);
            $(document).on('click', '.button-media_manager', this.openModal);
            $('#media-manager').on('media-manager-loaded', this.mediaManagerLoaded);
            $(document).on('change', '.modal-file_upload_area', this.uploadMediaModal);
            $(document).on('click', '.icon_delete-media', this.removeMedia);

            $(document).on('click', '#media-manager #confirm', function () {
                if ($('#media-manager').hasClass('tinymce-manager')) {
                    FRW.MediaManager.selected_models.forEach(function ($item) {
                        tinymce.activeEditor.execCommand('mceInsertContent', false, '<img src="' + FRW.MediaManager.media_path + "/uploads/" + $item.id + "/" + $item.file + '">');
                    });
                }
                else {
                    $(FRW.MediaManager.media_div).next('div.selected-images').html('');
                    FRW.MediaManager.selected_models.forEach(function ($item) {
                        $(FRW.MediaManager.media_div).next('div.selected-images').append('<div class="col-sm-2 selected-each_image"><img src="' + FRW.MediaManager.media_path + "/uploads/" + $item.id + "/200x200" + $item.file + '"></div>');
                        $(FRW.MediaManager.media_div).next('div.selected-images').append('<input type="hidden" name="' + FRW.MediaManager.field_name + '" value="' + $item.id + '">');
                    });
                    ;
                }
                $('#media-manager').modal("toggle");

            });
            $(document).on('click', '.media-image', function () {
                if (FRW.MediaManager.multiple == false) {
                    $('.media-image').each(function () {
                        $(this).removeClass('selected');
                    });
                    $(this).addClass('selected');
                    FRW.MediaManager.selected = [];
                    FRW.MediaManager.selected_models = [];
                    FRW.MediaManager.selected.push($(this).data('media-id'));
                    FRW.MediaManager.selected_models.push($(this).data('model'))
                } else {
                    $(this).toggleClass('selected');
                    if ($(this).hasClass('selected')) {
                        if ($.inArray($(this).data('media-id'), FRW.MediaManager.selected) == -1) {
                            FRW.MediaManager.selected.push($(this).data('media-id'));
                            FRW.MediaManager.selected_models.push($(this).data('model'))
                        }
                    } else {
                        FRW.MediaManager.selected.splice($.inArray($(this).data('media-id'), FRW.MediaManager.selected), 1);
                        FRW.MediaManager.selected_models.splice($.inArray($(this).data('model'), FRW.MediaManager.selected_models), 1);
                    }
                }
            });

            $('#media-manager').on('shown.bs.modal', function () {
                var $url = $(this).data('url');
                FRW.MediaManager.media_path = $(this).data('media-path');
                var $this = $(this);

                $.ajax({
                    url: $url
                }).done(function (data) {
                    $this.find('.modal-body').empty().append(data.view);
                    $this.trigger('media-manager-loaded');
                });
            });

            $(document).on('click', '.tab-media_manager', function () {
                $(this).prev('li').removeClass('active');
                $(this).addClass('active');
                var $url = $(this).data('url');
                $.ajax({
                    url: $url
                }).done(function (data) {
                    $('#media-manager').find('.modal-body').empty().append(data.view);
                    $('#media-manager').trigger('media-manager-loaded');
                });

            });

            $(document).on('click', '.tab-media_upload', function () {
                $(this).next('li').removeClass('active');
                $(this).addClass('active');
                var $url = $(this).data('url');
                $.ajax({
                    url: $url
                }).done(function (data) {
                    $('#media-manager').find('.modal-body').empty().append(data.view);
                    $('#media-manager').trigger('media-upload-loaded');
                    $('#media-manager').find('.uploading_div').hide();
                });
            });

            $(document).on('submit', '.modal-media_upload_form', function (e) {
                //e.preventDefault();
                //var $formData = new FormData($(this));
                //console.log($formData);
            });
        },

        mediaManagerLoaded: function () {
            FRW.MediaManager.selected = [];
            FRW.MediaManager.selected_models = [];

        },

        openUploader: function (e) {
            $('#fileupload').trigger('click');
            e.stopPropagation();

        },

        uploadMedia: function (e) {
            $(this).closest("form").submit();
        },

        openModal: function (e) {
            $('#media-manager').data('url', $(this).data('url'));
            $('#media-manager').removeClass('tinymce-manager');
            FRW.MediaManager.media_div = $(this);
            FRW.MediaManager.multiple = ($(this).data('multiple') == true) ? true : false;

            if (FRW.MediaManager.multiple == true)
                FRW.MediaManager.field_name = $(this).data('field') + '[]';
            else
                FRW.MediaManager.field_name = $(this).data('field');

            $('#media-manager').modal("show");
        },

        uploadMediaModal: function (e) {
            var $this_form = $(this).closest("form");
            var $form_url = $this_form.attr('action');
            var file_count = $("#modal-file_upload").prop("files").length;
            var form_data = new FormData();                  // Creating object of FormData class

            for (var i = 0; i < file_count; i++) {
                var file_data = $("#modal-file_upload").prop("files")[i];   // Getting the properties of file from file field
                form_data.append("media[]", file_data)
            }

            $('#media-manager').find('.uploading_div').show();
            $('#media-manager').find('.media-upload_form').hide();

            $.ajax({
                type: 'POST',
                url: $form_url,
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,

                success: function (data) {

                    $('#media-manager').find('.uploading_div').hide();
                    $('#media-manager').find('.media-upload_form').show();

                    data.forEach(function (each) {
                        $('#media-manager').find('.uploaded-image-block').append('<div class="uploaded-image"> <img src="' + FRW.MediaManager.media_path + '/uploads/' + each.id + '/' + each.file +
                            '" alt="" style="width:100%"></div>'
                        );
                    });
                },
                error: function (data) {
                    $('#imagedisplay').html("<h2>this file type is not supported</h2>");
                }
            });
        },

        removeMedia: function () {
            $(this).parent().next('input').val('-1');
            $(this).closest('div').remove();
        }

    };

    $(document).ready(function () {
        FRW.MediaManager.init();
    });

}(jQuery, FRW, window, document));
