;
(function ($, FRW, window, document, undefined) {
    'use strict';

    FRW.Image = {
        
        init: function(){
            $('.image-upload').on('change', function () {
                var $image = $($(this).data('preview'));
                var $image_path = $($(this)).data('image-path');
                var $image_name = this.value;
                var editor = $($(this).data('editor'));
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function imageIsLoaded(e) {
                        $image.attr('src', e.target.result);
                        $($image_path).html($image_name);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $('.delete-img').on('click', function () {
                var $image = $($(this).data('preview'));
                var $image_path = $($(this)).data('image-path');
                var $hidden = $($(this)).data('hidden');

                $image.attr('src', '');
                $($image_path).html('');
                $($hidden).val('');
            });

        }
    }

    $(document).ready(function ($) {
        FRW.Image.init();
    });

}(jQuery, FRW, window, document));
