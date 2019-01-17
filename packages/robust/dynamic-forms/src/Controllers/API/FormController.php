<?php

namespace Robust\DynamicForms\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\DynamicForms\Helpers\FormHelper;
use Robust\DynamicForms\Models\Data;
use Robust\DynamicForms\Models\Form;
use Robust\DynamicForms\Repositories\Admin\FormRepository;

/**
 * Class FormController
 * @package Robust\DynamicForms\Controllers\API
 */
class FormController extends Controller
{
    /**
     * @param Request $request
     * @param FormHelper $helper
     * @param FormRepository $form
     * @param Data $data
     * @return array
     */
    public function data(Request $request, FormHelper $helper, FormRepository $form, Data $data)
    {
        $slug = $request->get('slug');
        $form = $form->where('slug', '=', $slug)->get()->first();
        $dimensions = [$form->fields->where('type', '!=', 'number')->pluck('label', 'label')];
        $measures = [$form->fields->where('type', 'number')->pluck('label', 'label')];
        if (isset($form)) {
            $results = $data->select('values')->where('form_id', $form->id)->get();

            $data = [];
            if ($results) {
                foreach ($results as $result) {
                    $fields = json_decode($result->values, true);
                    $data[] = $helper->setLabelForRow($fields);
                }
            }
            return (isset($data) ? ['data' => $data, 'fields' => $dimensions, 'measures' => $measures] : []);
        }

        return [];
    }


    /**
     * @param FormRepository $form
     * @return array
     */
    public function forms(FormRepository $form)
    {
        $all = Form::all();
        return $all;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /* public function generateForm(Form $form, Request $request, $monitoring_id)
     {

         $project = \Robust\Projects\Models\Project::find($request->get('project_id'));
         $count_form = $form->where('form_group_id', $project->id)->get()->count();
         $monitoring = \Robust\Projects\Models\Monitoring::find($monitoring_id);

         $data['title'] = "{$monitoring->name} - {$count_form}";
         $data['slug'] = str_slug("Form - {$count_form}");
         $data['form_group_id'] = $project->id;
         $data['pages'] = 1;

         $demography_fields = [];
         $targets = Target::all();
         foreach ($targets as $target) {
             $demography_fields = array_merge($demography_fields, $target->identificationFields()->get(['type', 'name', 'order'])->toArray());

         }
         $form = $form->create($data);
         foreach ($demography_fields as $key => $each) {
             $count = FormField::where('form_id', $form->id)->count();
             $field = FormField::create(
                 [
                     'form_id' => $form->id,
                     'name' => "Field-{$count}",
                     'label' => $each['name'],
                     'field_name' => 'Field name',
                     'type' => $each['type'],
                     'section_id' => 0,
                     'column_no' => 0,
                     'properties' => json_encode([]),
                     'conditions' => json_encode([]),
                     'page_no' => 1,
                 ]);

             $field->order = $each['order'];
             $field->update();
         }
         foreach ($monitoring->indicators as $indicator) {
             $count = FormField::where('form_id', $form->id)->count();
             FormField::create(
                 [
                     'form_id' => $form->id,
                     'name' => "Field-{$count}",
                     'label' => $indicator->name,
                     'field_name' => 'Field name',
                     'type' => $indicator->type,
                     'section_id' => 0,
                     'column_no' => 0,
                     'properties' => $indicator->properties,
                     'conditions' => json_encode([]),
                     'page_no' => 1,
                 ]);
         }

         return response()->json(['message' => 'successfully created', 'redirect_url' => route("admin.dynamic-forms.index")]);
     }*/

    /**
     * @param $project_id
     * @return \Illuminate\Http\JsonResponse
     */
    function getFormsByProject($project_id)
    {
        $forms = Form::where('form_group_id', $project_id)->get();
        return response()->json(['data' => $forms]);

    }

}
