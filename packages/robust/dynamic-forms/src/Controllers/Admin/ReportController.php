<?php

namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\DynamicForms\Repositories\Admin\DataRepository;

/**
 * Class ReportController
 * @package Robust\DynamicForms\Controllers\Admin
 */
class ReportController extends Controller
{
    use ViewTrait;

    /**
     * ReportController constructor.
     */
    public function __construct(DataRepository $model)
    {
        $this->model = $model;
    }


}
