<?php

namespace Robust\Core\Repositories\Traits;

/**
 * Class PolyMorphRepositoryTrait
 * @package Robust\Core\Repositories\Traits
 */
trait PivotRepositoryTrait
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
        $type = $data['relation_type'];
        $model = $this->model->create($data);

        $model->$type()->sync($data[$this->relation[$type]]);
        return $model;
    }


    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $type = $data['relation_type'];
        $model = $this->model->find($id)->update($data);

        $this->model->find($id)->$type()->sync($data[$this->relation[$type]]);
        return $model;
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
