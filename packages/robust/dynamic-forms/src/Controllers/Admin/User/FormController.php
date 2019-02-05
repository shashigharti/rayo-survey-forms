<?php

namespace Robust\DynamicForms\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\DynamicForms\Repositories\Admin\FormRepository;


/**
 * Class FormController
 * @package Robust\DynamicForms\Controllers\Admin
 */
class FormController extends Controller
{
    use CrudTrait, ViewTrait;
    /**
     * FormController constructor.
     * @param FormRepository $model
     */
    public function __construct(FormRepository $model)
    {
        $this->model = $model;
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $model = $this->model->where('slug', $slug)->first();
        return view('dynamic-forms::admin.users.forms.view', compact('model'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFormJson($slug)
    {
        $model = $this->model->where('slug', $slug)->first();
        return response()->json($model);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFormById($id)
    {
        $model = $this->model->where('id', $id)->first();
        return response()->json($model);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllForms()
    {
        $model = $this->model->all();
        return response()->json($model);
    }

    public function showAllForms()
    {
        $data = $this->model->all();
        return view('dynamic-forms::admin.users.forms.all-forms', compact('data'));
    }


}
