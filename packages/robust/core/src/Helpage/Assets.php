<?php

namespace Robust\Core\Helpage;

use Robust\Core\Models\Media;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class Assets
 * @package Robust\Core\Helpage
 */
class Assets
{

    /**
     * @var array
     */
    protected $mimes = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * @param $id
     * @return string
     */
    public function getPath($id)
    {
        return storage_path() . '/uploads/' . $id . '/';
    }

    /**
     * @param $media
     * @param null $size
     * @return string
     */
    public function getImage($media, $size = null)
    {
        $external_url = getenv('ASSETS_URL');

        $dimensions = config('core.frw.image');
        if (config('media.image')) {
            $dimensions = array_merge(config('core.frw.image'), config('media.image'));
        }

        if (!is_numeric($media)) {
            if (!$size) {
                $size = 'large';
            }
            return $this->returnPlaceholder($size);
        }

        if ((is_null($media) || is_numeric($media)) && !($media = Media::find($media))) {
            return \Asset::images()->getImage(null, $size);
        }

        if (!$external_url && !file_exists($this->getPath($media->id) . $media->file)) {
            return '';
        }

        $image_dimension = $this->getDimensions($size);
        if (!$external_url)
            $this->checkAndReturnMedia($media->file, $media->id, $image_dimension, $dimensions, $size);

        if ($external_url) {
            return $external_url . '/uploads/' . $media->id . '/' . $image_dimension . $media->file;
        }

        return asset('/uploads/' . $media->id . '/' . $image_dimension . $media->file);
    }

    /**
     * @param $media_name
     * @param null $size
     * @param $media_id
     * @return string
     */
    public function getImageByName($media_name, $size = null, $media_id)
    {
        $external_url = getenv('ASSETS_URL');

        if (is_null($media_name) || $media_name == "") {
            if (!$size) {
                $size = 'large';
            }
            return $this->returnPlaceholder($size);
        }
        $dimensions = config('core.frw.image');
        if (config('media.image')) {
            $dimensions = array_merge(config('core.frw.image'), config('media.image'));
        }
        if (!$external_url && !file_exists($this->getPath($media_id) . $media_name)) {
            return '';
        }

        $image_dimension = $this->getDimensions($size);

        if (!$external_url)
            $this->checkAndReturnMedia($media_name, $media_id, $image_dimension, $dimensions, $size);

        if ($external_url) {
            return $external_url . '/uploads/' . $media_id . '/' . $image_dimension . $media_name;
        }
        return asset('/uploads/' . $media_id . '/' . $image_dimension . $media_name);
    }

    /**
     * @param $media
     * @param $media_id
     * @param $image_dimension
     * @param $dimensions
     * @param $size
     */
    public function checkAndReturnMedia($media, $media_id, $image_dimension, $dimensions, $size)
    {
        if (!file_exists($this->getPath($media_id) . $image_dimension . $media)) {
            $image = Image::make(storage_path() . '/uploads/' . $media_id . '/' . $media);

            $name_to_append = $dimensions[$size]['width'] . 'x' . $dimensions[$size]['height'] . $media;

            $image->resize($dimensions[$size]['width'], $dimensions[$size]['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();

            })->save($this->getPath($media_id) . $name_to_append);
        }
    }

    /**
     * @param $size
     * @return mixed
     */
    public function returnPlaceholder($size)
    {
        $placeholders = config('core.frw.placeholder');
        if (config('media.placeholder')) {
            $placeholders = array_merge(config('core.frw.placeholder'), config('media.placeholder'));
        }

        return $placeholders[$size];
    }

    /**
     * @param $size
     * @return string
     */
    public function getDimensions($size)
    {
        $dimensions = config('core.frw.image');
        if (config('media.image')) {
            $dimensions = array_merge(config('core.frw.image'), config('media.image'));
        }

        if (!$size || $size == 'original') {
            return '';
        }

        return $dimensions[$size]['width'] . 'x' . $dimensions[$size]['height'];
    }

    /**
     * @return Assets
     */
    public static function images()
    {
        return new self();
    }
}
