<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;


/**
 * Class ImageController
 * @package Robust\Core\Controllers\API
 */
class ImageController extends Controller
{
    /**
     * @param $id
     * @param $size
     * @return mixed
     */
    public function getImage($id, $size)
    {
        $image_path = \Asset::images()->getImage($id, $size);
        return \Image::make($image_path)->response();
    }
}
