<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Repositories\AssumptionRepository;

/**
 * Class IndicatorController
 * @package Robust\Projects\Controllers\Admin
 */
class AssumptionController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * IndicatorController constructor.
     * @param Request $request
     * @param IndicatorRepository $indicator
     */
    public function __construct(
        Request $request,
        AssumptionRepository $assumption
    )
    {
        $this->model = $assumption;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Assumption';
        $this->package_name = 'projects';
        $this->view = 'admin.assumptions';
        $this->ajax_view = 'admin.ajax.assumptions';
        $this->title = 'Assumptions';
    }

}
