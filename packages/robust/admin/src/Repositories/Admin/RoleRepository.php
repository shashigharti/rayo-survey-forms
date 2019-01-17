<?php

namespace Robust\Admin\Repositories\Admin;

use Robust\Admin\Models\Permission;
use Robust\Admin\Models\Role;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;

/**
 * Class RoleRepository
 * @package Robust\Admin\Repositories
 */
class RoleRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * @var Role
     */
    private $role;

    /**
     * RoleRepository constructor.
     * @param Role $model
     * @param Permission $permission
     */
    public function __construct(Role $model, Permission $permission)
    {
        $this->model = $model;
        $this->permissions = $permission;
    }

    /**
     * @param $data
     */
    public function store($data)
    {
        $permission_ids = Permission::whereIn('name', $data['permission'])->pluck('id');
        $role = $this->model->create($data);
        $role->permissions()->sync($permission_ids->toArray());
    }


    /**
     * @param $id
     * @param $data
     */
    public function update($id, $data)
    {

        $permission_ids = [];
        if(isset($data['permission'])){
            $permission_ids = Permission::whereIn('name', $data['permission'])->pluck('id')->toArray();
        }
        $role = $this->model->find($id);
        $role->update($data);
        $role->permissions()->sync($permission_ids);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $role = $this->model->findOrFail($id);
        return $role->delete();
    }
}