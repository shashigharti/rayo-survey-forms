<?php

namespace Robust\Core\Controllers\Admin\Ajax\Traits;

use Illuminate\Http\Request;

/**
 * Class CrudTrait
 * @package Robust\Core\Controllers\Admin\Ajax\Traits
 */
trait CrudTrait
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $records = $this->model->get();
        return response()->json(['data' => $records]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        parse_str($request->getQueryString(), $query_params);
        $model = $this->model->getModel();

        $view = $this->display("{$this->package_name}::{$this->ajax_view}.create", [
            'model' => $model,
            'query_params' => $query_params
        ])->render();
        return response()->json(['view' => $view]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        parse_str($request->getQueryString(), $query_params);
        $model = $this->model->find($id);

        $view = $this->display("{$this->package_name}::{$this->ajax_view}.create", [
            'model' => $model,
            'query_params' => $query_params
        ])->render();
        return response()->json(['view' => $view]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $this->model->delete($id);
        return response()->json(['status' => 1, 'message' => 'Successfully Deleted']);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $model = $this->model->store($data);
        if (isset($this->events['store'])) {
            $event = $this->events['store'];
            event(new $event($model));
        }

        return response()->json(['status' => 1, 'message' => 'Successfully Saved!']);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        $model = $this->model->update($id, $data);

        if (isset($this->events['update'])) {
            $event = $this->events['update'];
            event(new $event($model));
        }

        return response()->json(['status' => 1, 'message' => 'Successfully Saved!']);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->model->find($id);
        return response()->json(['data' => $data]);
    }

}
