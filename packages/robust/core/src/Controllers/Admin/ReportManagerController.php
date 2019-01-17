<?php

namespace Robust\Core\Controllers\Admin;

use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\ReportRepository;

/**
 * Class ReportManagerController
 * @package Robust\Core\Controllers\Admin
 */
class ReportManagerController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * ReportController constructor.
     * @param ReportRepository $report
     */
    public function __construct(ReportRepository $report)
    {
        $this->model = $report;
        $this->ui = 'Robust\Core\UI\Report';
        $this->package_name = 'core';
        $this->view = 'admin.report-manager';
        $this->title = 'Reports';
    }
}