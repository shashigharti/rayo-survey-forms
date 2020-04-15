<?php

namespace Robust\Core\Repositories\API\Traits;

/**
 * Class SearchRepositoryTrait
 * @package Robust\Core\Repositories\API\Traits
 */
trait SearchRepositoryTrait
{


    /**
     * @param $attr
     * @param $value
     * @param bool $multiple
     * @return mixed
     */
    public function findBy($attr, $value, $multiple = false)
    {
        // If want to find by multiple where clauses, value = null in such cases
        if($multiple)
            return $this->model->where($attr)->paginate(settings('app-setting', 'pagination'));
        else
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
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $field
     * @param $values
     * @return $this
     */
    public function whereBetween($field, $values)
    {
        $this->model = $this->model->whereBetween($field,$values);
        return $this;
    }

    /**
     * @param $relation
     * @return $this
     */
    public function has($relation)
    {
        $this->model = $this->model->has($relation);
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function withCount($field)
    {
        $this->model = $this->model->withCount($field);
        return $this;
    }

    /**
     * @param $field
     * @param $operator
     * @param $value
     * @return $this
     */
    public function having($field, $operator, $value)
    {
        $this->model = $this->model->having($field,$operator,$value);
        return $this;
    }
}
