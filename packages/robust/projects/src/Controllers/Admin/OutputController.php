<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\DynamicForms\Repositories\Admin\FormRepository;
use Robust\Projects\Repositories\OutputRepository;
use Robust\Projects\Repositories\ProjectRepository;

class OutputController extends Controller
{
    use CrudTrait, ViewTrait;

    public function __construct(
        Request $request,
        OutputRepository $outputs,
        FormRepository $form,
        ProjectRepository $project
    )
    {
        $this->model = $outputs;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Output';
        $this->package_name = 'projects';
        $this->view = 'admin.outputs';
        $this->ajax_view = 'admin.ajax.outputs';
        $this->title = 'Outcomes';
        $this->project = $project;
    }
}
