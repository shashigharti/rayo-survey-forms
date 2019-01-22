;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Editor = {
        init: function () {
            $(document).on('focusin', function(e) {
                if ($(event.target).closest(".mce-window").length) {
                    e.stopImmediatePropagation();
                }
            });
            var editor_config = {
                selector: "textarea.editor",
                path_absolute: "/",
                resize: "both",
                element_format: 'html',
                setup: function (editor) {
                    editor.on('blur', function () {
                        tinymce.triggerSave();
                        $('.ui-selected .description-editor').trigger('input');
                    });

                    editor.addButton('newmedia', {
                        text: 'Media Manager',
                        title: 'Open media Manager',
                        icon: 'image',
                        onclick: FRW.Editor.MediaManager
                    });
                },
                plugins: [
                    "autoresize advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | fontselect fontsizeselect  | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image newmedia",
                relative_urls: false,
                indentation: '20pt',


            };
            tinymce.init(editor_config);
        },

        MediaManager: function () {
            $('#media-manager').data('url', '/medias/type/image');
            FRW.MediaManager.multiple = false;
            $('#media-manager').addClass('tinymce-manager');
            $('#media-manager').modal("show");
        }
    };
    $(document).ready(function ($) {
        FRW.Editor.init();
    });
}(jQuery, FRW, window, document));
