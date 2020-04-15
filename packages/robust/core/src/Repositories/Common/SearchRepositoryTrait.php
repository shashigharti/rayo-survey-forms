<?php

namespace Robust\Core\Repositories\Common\Traits;

trait SearchRepositoryTrait
{

    /**
     * @param $attr
     * @param $value
     * @return mixed
     */
    public function findBy($attr, $value)
    {
        return $this->model->where($attr, $value)->paginate(settings('app-setting', 'pagination'));
    }


    /**
     * @param $params
     * @return mixed
     */
    public function search($params)
    {
        $query = $this->model;
        foreach ($params as $attr => $value) {
            $query->where($attr, $value);
        }

        return $query->get();
    }

    /**
     * Find a particular row
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a particular row otherwise fail
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function where($field, $value, $operator = '=')
    {
        $this->model = $this->model->where($field, $operator, $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function whereIn($param, $value)
    {
        $this->model = $this->model->whereIn($param, $value);
        return $this;
    }

    /**
     * @return class
     */
    public function whereHas($field, $callback){
        $this->model = $this->model->whereHas($field, $callback);
        return $this;
    }


    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }
    
}
