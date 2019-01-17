<?php

namespace Robust\Core\Repositories\Traits;

/**
 * Class CommonRepositoryTrait
 * @package Robust\Core\Repositories\Traits
 */
trait CommonRepositoryTrait
{

    /**
     * @return mixed
     */
    public function paginate($records = null)
    {
        $records = ($records == null) ? settings('app-setting', 'pagination') : $records;
        return $this->model->paginate($records);
    }

    /**
     * @param $field
     * @return $this
     */
    public function orderBy($field, $order_type = null)
    {
        $this->model = $this->model->orderBy($field, $order_type);
        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function limit($number)
    {
        $this->model = $this->model->limit($number);
        return $this;

    }


    /**
     * @param $id
     */
    public function toggleStatus($id)
    {
        $model = $this->model->find($id);
        $model->status = ($model->status == 0) ? 1 : 0;
        $model->save();

    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @return $this
     */
    public function enabled()
    {
        $this->model = $this->model->enabled();
        return $this;
    }

    /**
     * @return $this
     */
    public function disabled()
    {
        $this->model = $this->model->disabled();
        return $this;
    }

    /**
     * @param $relation
     * @return $this
     */
    public function with($relation)
    {
        $this->model = $this->model->with($relation);
        return $this;
    }

    /**
     * @param $query_string
     * @return $this
     */
    public function raw($query_string)
    {
        $this->model = $this->model->raw($query_string);
        return $this;
    }

    /**
     * @param $select_string
     * @return $this
     */
    public function select($select_string)
    {
        $this->model = $this->model->select($select_string);
        return $this;
    }


    /**
     * @param $select
     * @param array $conditions
     * @param array $order_by
     * @return mixed
     */
    public function buildQuery($table, $fields, $conditions = [], $order_by = [], $joins = [])
    {
        $query = \DB::table($table);

        foreach ($conditions as $condition) {
            $query = $query->where($condition['field'], $condition['operator'],
                isset($this->search_fields[$condition['value']]) ? $this->search_fields[$condition['value']] : $condition['value']);
        }

        foreach ($order_by as $key => $field) {
            $query = $query->orderBy($field, 'asc');
        }

        foreach ($joins as $key => $join) {
            $query = $query->leftJoin($join['table'], $join['table1_field'], "=", $join['table2_field']);
        }


        return $query->select(\DB::raw($fields));

    }
}
