<?php

namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Ajax\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\DynamicForms\Models\FormField;
use Robust\DynamicForms\Repositories\Admin\FormFieldRepository;
use Robust\DynamicForms\Repositories\Admin\FormRepository;

/**
 * Class FormFieldController.
 */
class FormFieldController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * FormFieldController constructor.
     * @param FormFieldRepository $model
     */
    public function __construct(
        FormFieldRepository $model
    )
    {
        $this->model = $model;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['properties'] = json_encode([]);
        $data['conditions'] = json_encode([]);
        $data['required'] = isset($data['required']) ? 1 : 0;

        if ($data['type'] == 'checkbox' || $data['type'] == 'select' || $data['type'] == 'radio') {
            $data['properties'] = json_encode(['options' =>
                "option1, option2"
            ]);
        }

        $model = $this->model->store($data);

        if (isset($this->events['store'])) {
            $event = $this->events['store'];
            event(new $event($model));
        }

        $model->update(['name' => "f_{$model->id}"]);
        $model->update(['order' => $model->max('order')]);

        $view = view('dynamic-forms::admin.forms.partials.element', [
            'field' => $model
        ]);
        return response()->json(['ui_view' => "$view", 'id' => $model->id]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['properties'] = json_encode($data['properties']);
        $data['required'] = isset($data['required']) ? 1 : 0;
        $this->model->update($id, $data);
        $view = view('core::admin.partials.messages.info', ['message' => 'Saved!']);

        return response()->json(['message' => "{$view}"]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $field = $this->model->find($id);
        $this->model->delete($id);

        return redirect()->back()->with(['current_page' => $field->page_no]);
    }


    /**
     * @param Request $request
     */
    public function sort(Request $request)
    {
        $data = $request->all();

        if (count($data['fields']) > 0) {
            $orders = $data['orders'];
            foreach ($data['fields'] as $key => $each_field) {
                $field = FormField::find($each_field);
                if ($field) {
                    $field->order = $orders[$key];
                    $field->save();
                }
            }
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_property($id)
    {
        $field = $this->model->where('id', $id)->first();
        return view("dynamic-forms::admin.forms.design.properties.$field->type", compact('field'));
    }

}
