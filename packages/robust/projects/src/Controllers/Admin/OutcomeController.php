<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Repositories\OutcomeRepository;

/**
 * Class OutcomeController
 * @package Robust\Projects\Controllers\Admin
 */
class OutcomeController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * OutcomeController constructor.
     * @param Request $request
     * @param OutcomeRepository $outcome
     */
    public function __construct(
        Request $request,
        OutcomeRepository $outcome
    )
    {
        $this->model = $outcome;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Outcome';
        $this->package_name = 'projects';
        $this->view = 'admin.outcomes';
        $this->ajax_view = 'admin.ajax.outcomes';
        $this->title = 'Outcomes';
    }
}
