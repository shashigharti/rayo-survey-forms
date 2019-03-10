<?php
namespace Robust\Reports\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Reports\Repositories\Admin\ReportRepository;

/**
 * Class DesignerController
 * @package Robust\Reports\Controllers\Admin
 */
class DesignerController extends Controller
{

    /**
     * DesignerController constructor.
     * @param Request $request
     */
    public function __construct(
        Request $request
    )
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_controlbox()
    {
        $view = view("reports::admin.reports.design.partials.controlbox");
        return response()->json(['ui_view' => "$view"]);
    }


    /**
     * @param $id
     * @param ReportRepository $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_template($id, ReportRepository $report)
    {
        $data = $this->request->all();
        $report->update($id, ['template' => preg_replace("/\r|\n/", "", $data['template']), 'html' => preg_replace("/\r|\n/", "", $data['html'])]);
        return response()->json(['message' => 'Successfully Saved']);
    }



    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_field_property($type)
    {
        $type = (preg_match("/^column/", $type) > 0) ? 'column' : $type;
        $view = view("reports::admin.reports.design.elements.properties.$type");
        return response()->json(['ui_view' => "$view"]);
    }
}
