<?php

namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate(PDF $pdf, Request $request)
    {
        $fields = $request->has('fields') ? explode(",", $request->get('fields')) : explode(",", $request->get('all_fields'));
        $order_by = $request->has('order_by') ? explode(",", $request->get('order_by')) : [];
        $conditions = $request->has('conditions') ? json_decode($request->get('conditions'), true) : [];

        $select_fields = [];
        foreach ($fields as $key => $field) {
            $select_fields[$key] = "values->$field as {$field}";
        }
        $query = $this->model->select($select_fields);

        foreach ($order_by as $key => $field) {
            $query = $query->orderBy($field, 'asc');
        }

        foreach ($conditions as $condition) {
            $field = $condition['field'];
            $value = $condition['value'];
            $query = $query->where("values->$field", $value);
        }

        $results = $query->get();

        $view = view('dynamic-forms::admin.reports.partials.advance.report', [
            'results' => $results,
            'fields' => $fields
        ]);

        return $pdf->loadHTML($view)->stream('report.pdf');
    }

}
