<?php

namespace Robust\Core\Repositories\Traits;
/**
 * Class CrudRepositoryTrait
 * @package Robust\Core\Repositories\Traits
 */
trait CrudRepositoryTrait
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Create a new row
     *
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function store($data)
    {
        return $this->model->create($data);
    }


    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Delete a particular row
     *
     * @param  integer $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $columns
     * @return mixed
     */
    public function get($columns = [])
    {
        if ($columns) {
            $this->model->get($columns);
        }
        return $this->model->get();
    }

}
