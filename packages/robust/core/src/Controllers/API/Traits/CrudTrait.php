<?php
namespace Robust\Core\Controllers\API\Traits;

use Illuminate\Http\Request;

/**
 * Class CrudTrait
 * @package Robust\Core\Controllers\API\Traits
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

        return response()->json(['status' => 1, 'message' => 'Successfully Saved!', 'data' => [$model]]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->model->find($id);
    }

}
