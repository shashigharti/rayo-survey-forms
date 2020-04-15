<?php

namespace Robust\Core\Controllers\Website;

use Illuminate\Support\Facades\Storage;

/**
 * Class SitemapController
 * @package Robust\Core\Controllers\Website
 */
class SitemapController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function index()
    {
        $contents = Storage::disk('local')->get('sitemaps/sitemap.xml');
        return response($contents)->header('Content-Type', 'text/xml');
    }
}
