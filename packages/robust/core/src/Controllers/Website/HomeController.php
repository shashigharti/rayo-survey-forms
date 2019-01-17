<?php

namespace Robust\Core\Controllers\Website;

use Robust\Cart\Models\Address;
use Robust\Core\Controllers\Admin\Controller;
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
        return view(Site::templateResolver('core::website.home'), [
            'page' => 'home'
        ]);
    }

}