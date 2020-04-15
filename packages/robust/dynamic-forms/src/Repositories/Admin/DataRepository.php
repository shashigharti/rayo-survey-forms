<?php
namespace Robust\DynamicForms\Repositories\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Robust\DynamicForms\Models\Data;
use Robust\DynamicForms\Models\Form;

/**
 * Class DataRepository
 * @package Robust\DynamicForms\Repositories
 */
class DataRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * DataRepository constructor.
     * @param Data $data
     */
    public function __construct(Data $data)
    {
        $this->model = $data;
    }

    /**
     * @param $data
     */
    public function duplicateByRelation($data)
    {
        $this->model->create($data);
    }

    /**
     * @param $data
     * @return static
     */
    public function create($data)
    {
        $form_data = $this->model->where('user_id', \Auth::id())->where('form_id', $data['form_id'])->get();
        if ($form_data->count()) {
            $form_data->forceDelete();
        }
        return $this->model->create($data);
    }


    /**
     * @param Illuminate\Http\Request
     * @param $id
     * @return bool
     */
    public function store($id, $data)
    {
        foreach ($data['values'] as $key => $item) {
            if (!is_array($item) && is_uploaded_file($item)) {
                $file_data = $this->storeUploadedFile($item, $key);

                $data['values'][$key] = $file_data;
            }

        }

        $data['id'] = $id;
        $data['status'] = 1;
        if (Auth::user()) {
            $data['user_id'] = Auth::user()->id;
        } else {
            $data['user_id'] = 0;
        }
        $form = Form::find($data['form_id']);
        $data['values'] = json_encode($data['values']);

        if (Auth::user() && $form->single_submit) {
            $form_data = $this->model->where('user_id', Auth::user()->id)->first();
            if (!$form_data) {
                return $this->model->create($data);
            }
            $form_data->update($data);
            return $form_data;
        }

        $form_data = $this->model->find($id);

        if (!$form_data) {
            return $this->model->create($data);
        }


        $form_data->update($data);
        return $form_data;
    }


    /**
     * @param $file
     * @param $key
     * @return string
     */
    public function storeUploadedFile($file, $key)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = strtotime(\Carbon\Carbon::now()) . '_' . mt_rand(0, 99999) . '.' . $extension;
        $file_path = base_path('public/uploads') . '/' . $filename;
        File::put($file_path, File::get($file));

        return $filename;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
}
