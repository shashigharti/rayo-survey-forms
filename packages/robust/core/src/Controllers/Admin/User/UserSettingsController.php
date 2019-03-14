<?php

namespace Robust\Core\Controllers\Admin\User;

use Illuminate\Http\Request;
use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Admin\UI\User;
use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Helpers\MenuHelper;
use Robust\Core\Models\Menu;
use Robust\Core\Models\UserSetting;
use Robust\Core\Repositories\DashboardRepository;
use Robust\Core\Repositories\WidgetRepository;


/**
 * Class DashboardController
 * @package Robust\Core\Controllers\Admin\User
 */
class UserSettingsController extends Controller
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



    /**
     * @param $slug
     * @return $this
     */
    public function edit($slug = '')
    {
        $settings = UserSetting::when($slug, function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->first();

        $all_settings = UserSetting::all();

        return $this->display('core::admin.users.settings.index',
            [
                'settings' => ($settings) ? json_decode($settings->values, true) : [],
                'slug' => $slug,
                'all_settings' => $all_settings
            ]
        );
    }


}
