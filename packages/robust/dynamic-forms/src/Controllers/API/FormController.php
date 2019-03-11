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
        foreach ($mis_surveys as $mis_survey) {
            $json_survey = json_encode($mis_survey, true);
            $data = [
                'form_id' => $mis_survey['formId'],
                'values' => $json_survey,
                'completed' => 1,
                'updated_at' => $mis_survey['updated_at'],
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
        $slug = $request->get('slug');
        $mis_survey = $request->except(['id', '_token', 'updated_at']);
        $json_survey = json_encode($mis_survey, true);
        $data = [
            'form_id' => $request->get('id'),
            'values' => $json_survey,
            'completed' => 1,
            'user_id' => Auth::id(),
            'updated_at' => $request->get('updated_at')
        ];
        $dynform_tbl->insert($data);

        return response('success');
    }

    /**
     * @param Request $request
     * @param Data $dynform_tbl
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateForm(Request $request, Data $dynform_tbl)
    {
        $dynform_tbl = $dynform_tbl->find($request->get('update_id'));
        $mis_survey = $request->except(['id', 'updated_at', 'update_id']);
        $json_survey = json_encode($mis_survey, true);
        $data = [
            'form_id' => $request->get('id'),
            'values' => $json_survey,
            'completed' => 1,
            'user_id' => Auth::id(),
            'updated_at' => $request->get('updated_at')
        ];
        $dynform_tbl->update($data);

        return response('success');
    }

    public  function allForms(){
        return response()->json(json_decode('{"_id":"5c84a07000b9d18c9e9c1943","type":"form","tags":[],"owner":null,"components":[{"type":"email","persistent":true,"unique":false,"protected":false,"defaultValue":"","suffix":"","prefix":"","placeholder":"Enter your email address","key":"email","lockKey":true,"label":"Email","inputType":"email","tableView":true,"input":true},{"type":"password","persistent":true,"protected":true,"suffix":"","prefix":"","placeholder":"Enter your password.","key":"password","lockKey":true,"label":"Password","inputType":"password","tableView":false,"input":true},{"theme":"primary","disableOnInvalid":true,"action":"submit","block":false,"rightIcon":"","leftIcon":"","size":"md","key":"submit","label":"Submit","input":true,"type":"button"}],"revisions":"","_vid":0,"title":"User Register","name":"userRegister","path":"user/register","access":[{"roles":["5c84a07000b9d166429c193f"],"type":"read_all"}],"submissionAccess":[{"roles":["5c84a07000b9d166429c193f"],"type":"create_own"}],"machineName":"oidsfffyigjdncg:userRegister","project":"5c84a07000b9d1fe669c193c","created":"2019-03-10T05:28:16.143Z","modified":"2019-03-10T05:28:16.146Z"}', true));

    }
}
