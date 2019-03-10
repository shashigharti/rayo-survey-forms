<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Repositories\MonitoringRepository;

/**
 * Class MonitoringController
 * @package Robust\Projects\Controllers\Admin
 */
class MonitoringController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * MonitoringController constructor.
     * @param Request $request
     * @param MonitoringRepository $project
     */
    public function __construct(
        Request $request,
        MonitoringRepository $project
    )
    {
        $this->model = $project;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Monitoring';
        $this->package_name = 'projects';
        $this->view = 'admin.monitorings';
        $this->ajax_view = 'admin.ajax.monitorings';
        $this->title = 'Monitorings';
        $this->table = 'core::admin.layouts.sub-layouts.list';
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateForms($id)
    {
        $monitoring = $this->model->find($id);
        $url = route('api.monitorings.forms.generate', [$monitoring->id]) . "?project_id={$monitoring->project_id}";
        // Get cURL resource
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "{$url}"
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        return redirect($resp->redirect_url)->with('message', 'Form has been created successfully!');
    }


}
