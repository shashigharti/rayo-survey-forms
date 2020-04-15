<?php

namespace Robust\Core\Repositories\Common\Traits;

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
     * if exits update or create a new row
     * @param $prev
     * @param $data
     * @return mixed
     */
    public function updateOrCreate($prev, $data)
    {
        return $this->model->updateOrCreate($prev,$data);
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
