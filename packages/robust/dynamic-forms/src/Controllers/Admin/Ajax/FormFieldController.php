<?php

namespace Robust\DynamicForms\Controllers\Admin\Ajax;

use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Ajax\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Controller;
use Robust\DynamicForms\Repositories\Admin\FormFieldRepository;


/**
 * Class FormFieldController
 * @package Robust\DynamicForms\Controllers\Admin\Ajax
 */
class FormFieldController extends Controller
{
    use  CrudTrait;

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
    public function index(Request $request)
    {
        if ($request->has('formId')) {
            $records = $this->model->where('form_id', $request->get('formId'))->get();
            return response()->json(['data' => $records]);
        }

        return response()->json(['data' => '']);
    }

}