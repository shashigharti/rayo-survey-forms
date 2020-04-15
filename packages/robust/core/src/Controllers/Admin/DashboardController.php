<?php

namespace Robust\Core\Controllers\Admin;

use Illuminate\Http\Request;
use Robust\Core\Models\User;
use Robust\Core\Repositories\Admin\UserRepository;
use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Repositories\Admin\DashboardRepository;
use Robust\Core\Repositories\Admin\WidgetRepository;

/**
 * Class DashboardController
 * @package Robust\Core\Controllers\Admin
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
        $this->view = 'admin.dashboards';
        $this->title = 'Dashboards';
        $this->previous_url = route('admin.home');
        $this->middleware('auth');
    }

    /**
     * @param WidgetRepository $widget
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDashboardWidget(WidgetRepository $widget, User $user, Request $request)
    {
        parse_str($request->getQueryString(), $query_params);
        $dashboard = $this->model->find($query_params['parent_id']);
        $widgets = $widget->all();
        return response()->json(['view' => $view]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDashboardWidget(Request $request)
    {
        $data = $request->all();
        $this->model->addWidgets($data);
        return redirect($this->previous_url)->with('message', 'Widgets successfully added!');
    }


    /**
     * @param UserRepository $user
     * @param null $slug
     * @return \Robust\Core\Controllers\Common\Traits\view
     */
    public function show(UserRepository $user, $slug = null)
    {
        $dashboard = $user->find(\Auth::user()->id)->dashboards->where('is_default', true)->first();
        if ($slug !== null) {
            $dashboard = $this->model->where('slug', $slug)->get()->first();
        }
        return $this->display('core::admin.dashboard',
            [
                'model' => $dashboard,
                'widgets' => $dashboard->widgets,
                'child_ui' => new \Robust\Core\UI\Widget
            ]
        );
    }
}
