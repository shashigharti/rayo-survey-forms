<?php

namespace Robust\DynamicForms\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
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
     * @param \Illuminate\Http\Request $request
     * @param \Robust\DynamicForms\Models\Data $dynform_tbl
     * @param null $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function submitForm(Request $request, Data $dynform_tbl, $id=null)
    {
        $slug = $request->get('slug');
        $mis_survey = $request->except(['id', '_token', 'updated_at']);
        $json_survey = json_encode($mis_survey, true);
        $data = [
            'form_id' => $request->has('id') ? $request->get('id') : $id,
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

    /**
     * @param \Robust\DynamicForms\Models\Form $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function allForms(Form $form){
        $allForms = $form->all()->toArray();
        $allForms = array_map(function($form) {
            return [
                '_id' => $form['id'],
                'title' => $form['title']
            ];
        }, $allForms);
        return response()->json($allForms);
    }

    /**
     * @param $id
     * @param \Robust\DynamicForms\Models\Form $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLiveForm($id, Form $form)
    {
        $liveForm = json_decode($form->find($id)->properties, true);
        return response()->json($liveForm);
    }

    public function getRecaptchaResponse(Request $request, Client $client)
    {
        $secret = '6LcV_pkUAAAAAHxUK7HsURaS0Pozt97zdUaV0mSy';
        $recaptchaToken = $request->get('recaptchaToken');
        try {
            $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => $secret,
                    'response' => $recaptchaToken,
                ]
            ]);
        } catch(Exception $e) {
            dd($e);
        }

        $jsonResponse = json_decode($response->getBody());
        return response()->json($jsonResponse);
    }
}
