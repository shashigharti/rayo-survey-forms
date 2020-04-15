<?php

namespace Robust\Core\Controllers\Website;

use Robust\Core\Helpage\Site;

/**
 * Class HomeController
 * @package Robust\Core\Controllers\Website
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $view = 'core::website.home';
        return view(Site::templateResolver($view), [
            'page' => 'home'
        ]);
    }

}
