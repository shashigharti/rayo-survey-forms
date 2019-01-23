<?php

namespace Robust\DynamicForms\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $dimensions = [];
        $measures = [];
        $data = [];
        if (isset($form)) {
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
     * Syncs offline data to live db
     * @param \Illuminate\Http\Request $request
     * @param \Robust\DynamicForms\Models\Data $dynform_tbl
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function sync(Request $request, Data $dynform_tbl)
    {
        // Add to db
        $mis_surveys = $request->all();
        foreach($mis_surveys as $mis_survey) {
            $json_survey = json_encode($mis_survey, true);
            $data = [
                'form_id' => 1,
                'values' => $json_survey,
                'completed' => 1,
                'user_id' => Auth::id()
            ];
            $dynform_tbl->insert($data);
        }

        return response('success');
    }



    /**
     * Retrieves the form by its id and returns a JSON value
     * @param $id
     * @param \Robust\DynamicForms\Models\Form $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function displayForm($id, Form $form)
    {
        $data = $form->where('id', $id)->get();
        return response()->json($data);
    }

    /**
     * Submission function for form data
     * @param \Illuminate\Http\Request $request
     * @param \Robust\DynamicForms\Models\Data $dynform_tbl
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function submitForm(Request $request, Data $dynform_tbl)
    {
        $mis_survey = $request->except('id');
        $json_survey = json_encode($mis_survey, true);
        $data = [
            'form_id' => $request->get('id'),
            'values' => $json_survey,
            'completed' => 1,
            'user_id' => Auth::id()
        ];
        $dynform_tbl->insert($data);

        return response('success');
    }
}
