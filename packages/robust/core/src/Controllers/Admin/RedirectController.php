<?php

namespace Robust\Core\Controllers\Admin;

use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\RedirectRepository;


/**
 * Class RedirectController
 * @package Robust\Core\Controllers\Admin
 */
class RedirectController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * RedirectController constructor.
     * @param Request $request
     * @param RedirectRepository $redirects
     */
    public function __construct(
        Request $request,
        RedirectRepository $redirects
    ) {
        $this->model = $redirects;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Redirect';
        $this->package_name = 'core';
        $this->view = 'admin.redirects';
        $this->title = 'Redirects';
    }
}
