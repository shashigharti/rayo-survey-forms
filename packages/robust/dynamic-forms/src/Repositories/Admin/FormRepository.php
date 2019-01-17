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
    public function store($data)
    {
        $data['components'] = json_encode($data['components']);
        return $this->model->create($data);
    }


    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $data['components'] = json_encode($data['components']);
        return $this->model->find($id)->update($data);
    }

    /**
     * @param $id
     * @param $roles
     */
    public function roles($id, $roles)
    {
        $roles = is_array($roles) ? $roles : [];
        $this->model->find($id)->roles()->sync($roles);
        if ($this->model->find($id)->roles->count() == 0 && $this->model->find($id)->users->count() == 0) {
            $this->model->find($id)->users()->sync([\Auth::user()->id]);
        }
    }

    /**
     * @param $id
     * @param $users
     */
    public function users($id, $users)
    {
        $users = is_array($users) ? $users : [];
        $this->model->find($id)->users()->sync($users);

        if ($this->model->find($id)->roles->count() == 0 && $this->model->find($id)->users->count() == 0) {
            $this->model->find($id)->users()->sync([\Auth::user()->id]);
        }
    }

}
