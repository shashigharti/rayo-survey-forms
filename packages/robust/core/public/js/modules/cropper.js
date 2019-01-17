;
(function ($, FRW, window, document, undefined) {
    'use strict';

    FRW.Cropper = {
        init: function ($image) {
            var $container = $($image.data('container'));
            var $dimensions = $($image.data('dimensions'));
            var $height = ($image.height() / $image.width()) * $container.width();
            $image.cropper({
                aspectRatio: $container.width() / $height,
                autoCropArea: $container.width() / $height,
                crop: function(e){
                    if($dimensions){
                        $dimensions.find('[name="x"]').val(e.x);
                        $dimensions.find('[name="y"]').val(e.y);
                        $dimensions.find('[name="width"]').val(e.width);
                        $dimensions.find('[name="height"]').val(e.height);
                    }
                }
            });
        }
    }

}(jQuery, FRW, window, document));
