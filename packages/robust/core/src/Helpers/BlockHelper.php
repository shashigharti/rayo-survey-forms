<?php
namespace Robust\Core\Helpers;

use Robust\Banners\Models\Banner;
use Robust\Pages\Models\Page;
/**
 * Class BlockHelper
 * @package Robust\Core\Helpers
 */
class BlockHelper
{

    /**
     * @return mixed
     */
    public function getBanners()
    {
        $banners = Banner::all();
        return $banners->pluck('name', 'id');
    }


    /**
     * @return mixed
     */
    public function getPages()
    {
        $pages = Page::all();
        return $pages->pluck('name', 'id');
    }



}