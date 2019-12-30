<?php

namespace Robust\DynamicForms\Repositories\Admin;

use Robust\Admin\Repositories\Admin\RoleRepository;
use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\DynamicForms\Models\Form;

/**
 * Class FormRepository
 * @package Robust\DynamicForms\Repositories
 */
class FormRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * @param Form $model
     */
    public function __construct(Form $model, RoleRepository $role, UserRepository $user)
    {
        $this->model = $model;
        $this->role = $role;
        $this->user = $user;
    }


    /**
     * @param $data
     * @return mixed
     */
   /* public function store($data)
    {
        $data['components'] = json_encode($data['components']);
        return $this->model->create($data);
    }*/


    /**
     * @param $id
     * @param $data
     * @return mixed
     */
   /* public function update($id, $data)
    {
        $data['components'] = json_encode($data['components']);
        return $this->model->find($id)->update($data);
    }*/

    /**
     * @return mixed
     */
    public function toSql()
    {
       return $this->model->toSql();
    }

    /**
     * @param $columns
     * @return mixed
     */
    public function pluck($columns)
    {
        return $this->model->pluck($columns);
    }

}
