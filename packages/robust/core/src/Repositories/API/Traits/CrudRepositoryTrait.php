<?php

namespace Robust\Core\Repositories\API\Traits;
/**
 * Class CrudRepositoryTrait
 * @package Robust\Core\Repositories\API\Traits
 */
trait CrudRepositoryTrait
{

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
     * Update a row
     *
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
}
