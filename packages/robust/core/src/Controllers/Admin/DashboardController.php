<?php
namespace Robust\Core\Controllers\Admin;

use Illuminate\Http\Request;
use Robust\Admin\Models\User;
use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\DashboardRepository;
use Robust\Core\Repositories\WidgetRepository;

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
    ) {
        $this->model = $dashboard;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Dashboard';
        $this->package_name = 'core';
        $this->view = 'admin.dashboards';
        $this->ajax_view = 'admin.ajax.dashboards';
        $this->title = 'Dashboards';
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

        $view = $this->display("{$this->package_name}::{$this->ajax_view}.add-widget", [
            'model' => $this->model->getModel(),
            'records' => $widgets,
            'dashboard_widgets' => $dashboard->widgets->pluck('id')->toArray(),
            'query_params' => $query_params
        ])->render();

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
     * @return $this
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
