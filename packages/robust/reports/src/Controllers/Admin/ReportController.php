<?php
namespace Robust\Reports\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Reports\Repositories\Admin\ReportRepository;

/**
 * Class ReportsController
 * @package Robust\Reports\Controllers\Admin
 */
class ReportController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * ReportsController constructor.
     * @param Request $request
     * @param ReportRepository $model
     */
    public function __construct(
        Request $request,
        ReportRepository $model
    )
    {
        $this->request = $request;
        $this->model = $model;
        $this->ui = 'Robust\Reports\UI\Report';
        $this->package_name = 'reports';
        $this->view = 'admin.reports';
        $this->title = 'Reports';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = with(new $this->ui)->addrules;
        $this->validate($request,
            $rules
        );
        $data['template'] = '';
        $data['html'] = '';
        $form = $this->model->store($data);

        return redirect(route("admin.report-designer.reports.edit", [$form->id]))->with('message', 'Report has been created successfully!');

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id)
    {
        $data = $this->request->all();

        $rules = with(new $this->ui)->editrules;
        $this->validate($this->request,
            $rules
        );

        $this->model->update($id, $data);
        return redirect(route("admin.report-designer.reports.index"))->with('message', 'Report updated successfully!');
    }


    /**
     * @param $id
     * @return $this
     */
    public function design($id)
    {
        $report = $this->model->find($id);

        return $this->display('reports::admin.reports.design.design', [
            'title' => 'Design Report',
            'model' => $report
        ]);
    }


    /**
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        $report = $this->model->find($id);
        return $this->display('reports::admin.reports.design.show', [
            'title' => 'Preview',
            'model' => $report
        ]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function preview($id)
    {
        $report = $this->model->find($id);
        return $this->display('reports::admin.reports.design.preview', [
            'model' => $report
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function post_element($id)
    {
        $type = $this->request->get('type');
        $view = view('reports::admin.reports.design.partials.element', compact('type'));
        return response()->json(['ui_view' => "$view"]);
    }

}
