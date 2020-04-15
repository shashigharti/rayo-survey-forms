<?php

namespace Robust\Core\Repositories\API\Traits;

/**
 * Class PolyMorphRepositoryTrait
 * @package Robust\Core\Repositories\API\Traits
 */
trait PolyMorphRepositoryTrait
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

        $morphable_id = $data['morphable_id'];
        $morphable_type = $data['morphable_type'];

        $morphable = $this->morphable[$morphable_type]::find($morphable_id);
        $id = $this->poly_morph[$this->morphed[$morphable_type]]['id'];
        $type = $this->poly_morph[$this->morphed[$morphable_type]]['type'];

        $data[$id] = $morphable->id;
        $data[$type] = $this->morphable[$morphable_type];
        return $this->model->create($data);
    }


    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $morphable_id = $data['morphable_id'];
        $morphable_type = $data['morphable_type'];

        $morphable = $this->morphable[$morphable_type]::find($morphable_id);
        $field_id = $this->poly_morph[$this->morphed[$morphable_type]]['id'];
        $field_type = $this->poly_morph[$this->morphed[$morphable_type]]['type'];

        $data[$field_id] = $morphable->id;
        $data[$field_type] = $this->morphable[$morphable_type];

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
