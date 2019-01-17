<?php

namespace Robust\Core\Controllers\Admin;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Robust\Core\Helpage\Site;
use Robust\Core\Repositories\ReportRepository;


/**
 * Class ReportController
 * @package Robust\Core\Controllers\Admin
 */
class ReportController extends Controller
{
    /**
     * ReportController constructor.
     * @param ReportRepository $report
     */
    public function __construct(ReportRepository $report)
    {
        $this->model = $report;
        $this->view = 'admin.report-manager';
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Excel $excel, PDF $pdf, Request $request, $id)
    {
        parse_str($request->getQueryString(), $query_params);
        $report = $this->model->find($id);
        $type = isset($query_params['type']) ? $query_params['type'] : '';
        unset($query_params['type']);


        if ($type == 'excel') {
            return $excel->create('individual', function ($excel) use ($report, $query_params) {
                $excel->sheet('1', function ($sheet) use ($report, $query_params) {
                    $sheet->loadView(Site::templateResolver("{$report->package_name}::admin.reports.partials.individual.report"),
                        [
                            'report' => $report,
                            'title' => 'Reports',
                            'query_params' => $query_params
                        ]);
                });
            })->download('xls');
        } elseif ($type == 'pdf') {
            $pdf = $pdf->loadView(Site::templateResolver("{$report->package_name}::admin.reports.partials.individual.report"),
                [
                    'report' => $report,
                    'title' => 'Reports',
                    'query_params' => $query_params
                ]);
            return $pdf->download('individual.pdf');
        }

        return view(Site::templateResolver("{$report->package_name}::admin.reports.{$report->file_name}"), [
            'report' => $report,
            'title' => 'Reports',
            'query_params' => $query_params
        ]);
    }
}