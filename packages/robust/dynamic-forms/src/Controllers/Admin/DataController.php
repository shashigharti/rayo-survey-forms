<?php

namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Helpage\Breadcrumb;
use Robust\Core\Helpers\MenuHelper;
use Robust\DynamicForms\Helpers\FormHelper;
use Robust\DynamicForms\Models\Form;
use Robust\DynamicForms\Repositories\Admin\DataRepository;
use Robust\DynamicForms\Repositories\Admin\FormRepository;
use League\Csv\Writer;

/**
 * Class DataController
 * @package Robust\DynamicForms\Controllers\Admin
 */
class DataController extends Controller
{
    use  CrudTrait, ViewTrait;

    /**
     * DataController constructor.
     * @param Request $request
     * @param DataRepository $model
     * @param FormRepository $form
     */
    public function __construct(
        Request $request,
        DataRepository $model,
        FormRepository $form
    )
    {
        $this->model = $model;
        $this->request = $request;
        $this->ui = 'Robust\DynamicForms\UI\Data';
        $this->package_name = 'dynamic-forms';
        $this->title = 'Datas';
        $this->view = 'admin.datas';
        $this->events = [
            'store' => 'Robust\DynamicForms\Events\FormSubmittedEvent'
        ];
    }


    /**
     * @param FormRepository $form
     * @param $id
     * @return mixed
     */
    public function show(FormRepository $form, $id)
    {

        $data = $this->model->find($id);
        $form = $form->find($data->form_id);
        Breadcrumb::getInstance()->setParameters('admin.forms.data.index', $form->id);
        return $this->display('dynamic-forms::admin.datas.show',
            [
                'model' => $form,
                'data' => $data,
            ]
        );
    }


    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $id = $request->get('data_id');
        $data['form_id'] = $request->get('form_id');
        $data['completed'] = $request->get('status_completed');
        $data['values'] = $request->except('data_id', 'is_submit_btn_clicked', '_token', '_previous', '_next', 'form_id', 'edit_mode', 'status_completed',
            'disable_request');

        $form_data = $this->model->store($id, $data);
        $message = ($form_data) ? 'Data successfully submitted!' : 'Error saving data!';
        if ($request->ajax()) {
            if ($form_data) {
                return $message = [
                    'result' => $message,
                    'completed' => $form_data->completed,
                    'data_id' => $form_data->id
                ];
            }
        }

        if ($request->get('edit_mode')) {
            return redirect()->route('admin.forms.data.index', $data['form_id'])->with('message', $message);

        }
        return redirect()->back()->with('message', $message);
    }


    /**
     * @param FormRepository $form
     * @param $id
     */
    public function export(FormRepository $form, $id)
    {
        $writer = Writer::createFromFileObject(new \SplTempFileObject());
        $form_helper = new FormHelper();

        $form = $form->find($id);
        $fields = $form->fields()->where('form_id', $id)->where('type', '<>', 'editor')->orderBY('id')->pluck('id', 'name')->toArray();

        $header = [];
        foreach ($fields as $name => $field) {
            $header[$name] = $form_helper->getQuestion($name);
        }


        $d_collection = [];
        foreach ($form->datas as $record) {
            $values = json_decode($record->values, true);

            $data = [];
            foreach ($fields as $name => $field) {
                $value = isset($values[$name]) ? $values[$name] : "";
                $data[] = is_array($value) ? implode(",", $value) : $value;
            }

            $d_collection[] = $data;
        }

        $object = new \ArrayIterator($d_collection);
        $writer->insertOne($header);
        $writer->insertAll($object);

        header('Content-Type: text/csv; charset=UTF-8');
        header("Content-Disposition: attachment; filename={$form->title}.csv");
        $writer->output("{$form->title}-" . rand() . '.csv');
        exit;
    }


    /**
     * @param FormRepository $form
     * @param $id
     * @return $this
     */
    public function print_(FormRepository $form, $id)
    {
        $data = $this->model->find($id);
        $form = $form->find($data->form_id);
        return $this->display('core::admin.layouts.print',
            [
                'template' => 'dynamic-forms::admin.datas.print',
                'records' => $data,
                'model' => $form,
            ]
        );
    }


    /**
     * @param Request $request
     * @param $form_id
     * @return $this
     */
    public function showFormData(Request $request, $form_id, Form $form){
        $owner = $form->find($form_id)->created_by === Auth::id();
        // Display those data entered by the specific user unless the user is the owner of the form
        if($owner) {
            $records = $this->model->findBy('form_id', $form_id);
        } else {
            $records = $this->model->findBy([
                ['form_id', $form_id],
                ['user_id', Auth::id()],
            ], '', true);
        }

        return $this->display($this->table,
            [
                'records' => $records,
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $this->package_name,
            ]
        );
    }
}
