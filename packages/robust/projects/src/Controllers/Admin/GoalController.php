<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Repositories\GoalRepository;

/**
 * Class GoalController
 * @package Robust\Projects\Controllers\Admin
 */
class GoalController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * GoalController constructor.
     * @param Request $request
     * @param GoalRepository $project
     */
    public function __construct(
        Request $request,
        GoalRepository $project
    )
    {
        $this->model = $project;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Goal';
        $this->package_name = 'projects';
        $this->view = 'admin.goals';
        $this->ajax_view = 'admin.ajax.goals';
        $this->title = 'Goals';
        $this->table = 'core::admin.layouts.sub-layouts.list';
    }

}
