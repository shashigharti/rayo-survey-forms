<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Projects\Repositories\TargetRepository;

/**
 * Class TargetController
 * @package Robust\Projects\Controllers\Admin
 */
class TargetController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * TargetController constructor.
     * @param Request $request
     * @param TargetRepository $project
     */
    public function __construct(
        Request $request,
        TargetRepository $project
    )
    {
        $this->model = $project;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Target';
        $this->package_name = 'projects';
        $this->view = 'admin.targets';
        $this->ajax_view = 'admin.ajax.targets';
        $this->title = 'Targets';
        $this->table = 'core::admin.layouts.sub-layouts.list';
    }

}
