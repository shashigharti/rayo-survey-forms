<?php

namespace Robust\Core\Repositories\Common\Traits;

/**
 * Class FilterRepositoryTrait
 * @package Robust\Core\Repositories\Common\Traits
 */
trait FilterRepositoryTrait
{

    /**
     * @param $params
     * @return mixed
     */
    public function filter($params)
    {
        // $order_by = isset($params['sort_by']) ? 'price' : 'order';
        // $query = $this->model;
        // foreach ($params as $key => $value) {
        //     if (!isset($this->fields[$key])) {
        //         continue;
        //     }

        //     $field = $this->fields[$key];

        //     if (isset($field['relation'])) {
        //         $relation = $field['relation'];
        //         $query = $query->whereHas($relation, function ($query) use ($field, $value) {
        //             $query->where($field['fieldname'], isset($field['operator']) ? $field['operator'] : '=', $value);
        //         });
        //     } else {
        //         $query = $query->where($field['fieldname'], isset($field['operator']) ? $field['operator'] : '=', $value);
        //     }
        // }
        // $query = $query->orderBy($order_by, isset($params['sort_by']) ? $params['sort_by'] : 'desc');
        // $paginate = settings('app-setting', 'pagination');
        // return ($paginate) ? $query->enabled()->paginate($paginate) : $query->enabled()->paginate(20);
    }

}
