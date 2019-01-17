<?php

namespace Robust\Core\Controllers\Website;

use Illuminate\Support\Facades\Storage;
use Robust\Core\Controllers\Admin\Controller;

/**
 * Class SitemapController
 * @package packages\robust\core\src\Controllers\Website
 */
class SitemapController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $contents = Storage::disk('local')->get('sitemaps/sitemap.xml');
        return response($contents)->header('Content-Type', 'text/xml');
    }
}