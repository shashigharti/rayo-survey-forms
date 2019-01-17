<?php

Form::macro('media', function ($media = null, $options) {
    $defaults = [
        'field-name' => 'media_id',
        'multiple' => false,
        'button' => 'Add Media',
    ];
    $html = "";
    $options = array_merge($defaults, $options);
    if ($media && $media->id) {

        if ($media[$options['field-name']] != "") {

            $html = sprintf(
                '<div class="form-group form-m<aterial row">
                                         <div class="col-sm-12">
                                       <div class="selected-images">
                                       <div class="col-sm-2 selected-each_image">
                                            <i class="fa fa-times icon_delete-media"></i>
                                            <img src="' . \Asset::images()->getImage($media[$options['field-name']], 'small') . '">
                                        </div>
                                        <input type="hidden" name="' . $options['field-name'] . '" value="' . $media[$options['field-name']] . '">
                                       </div>
                                       </div>
                                 </div>'
            );
        }
    } else {
        $html = '<div class="form-media__empty"></div>';
    }
    return sprintf('
                <div class="form-group form-material row">
                        <div class="col-sm-12">

                    %s
                      <div class="selected-images">
  %s
                      </div>
                      </div>
                </div>
',
        '<input' .
        ' class="btn theme-btn button-media_manager"' .
        ' type="button" value="' . $options['button'] . '"' .
        ' data-multiple="' . ($options['multiple'] ? 'true' : 'false') . '"' .
        ' data-url="' . route('admin.media.modal.type', 'image') . '"' .
        ' data-field="' . $options['field-name'] . '"' .
        '>', $html

    );

});