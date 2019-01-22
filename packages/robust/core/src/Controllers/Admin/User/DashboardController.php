<?php

namespace Robust\Core\Controllers\Admin\User;

use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\DashboardRepository;


/**
 * Class DashboardController
 * @package Robust\Core\Controllers\Admin\User
 */
class DashboardController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * DashboardController constructor.
     * @param Request $request
     * @param DashboardRepository $dashboard
     */
    public function __construct(
        Request $request,
        DashboardRepository $dashboard
    )
    {
        $this->model = $dashboard;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Dashboard';
        $this->package_name = 'core';
        $this->view = 'admin.users.dashboards';
        $this->title = 'Dashboards';
    }
}
