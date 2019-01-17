<?php

namespace  Robust\Core\Controllers;

use Robust\Core\Controllers\Admin\Controller;

/**
 * Class FormController
 * @package Robust\Core\Controllers
 */
class FormController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('core::website.forms.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('core::website.forms.show');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('core::website.forms.edit');
    }

}