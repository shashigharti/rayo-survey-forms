<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Repositories\ActivityRepository;

/**
 * Class ActivityController
 * @package Robust\Projects\Controllers\Admin
 */
class ActivityController extends Controller
{
    use CrudTrait, ViewTrait;

    
    public function __construct(
        Request $request,
        ActivityRepository $project
    )
    {
        $this->model = $project;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Activity';
        $this->package_name = 'projects';
        $this->view = 'admin.activities';
        $this->ajax_view = 'admin.ajax.activities';
        $this->ajax_view = 'admin.ajax.activities';
        $this->title = 'Activities';
        $this->table = 'core::admin.layouts.sub-layouts.list';
    }

}
