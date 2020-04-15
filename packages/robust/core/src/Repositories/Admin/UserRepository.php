<?php

namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\Role;
use Robust\Core\Models\User;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;

/**
 * Class UserRepository
 * @package Robust\Admin\Repositories\Admin
 */
class UserRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * @var User
     */
    private $users;

    /**
     * @var Role
     */
    private $roles;

    /**
     * UserRepository constructor.
     * @param User $users
     * @param Role $roles
     */
    public function __construct(User $users, Role $roles)
    {
        $this->model = $users;
        $this->roles = $roles;
    }


    /**
     * @param $data
     * @return static
     */
    public function store($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->model->create($data);

        if(isset($data['roles'])){
            $user->roles()->sync($data['roles']);
        }

        return $user;
    }


    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($id, $data)
    {
        $user = $this->model->findOrFail($id);

        if ($user) {
            $user->update($data);
            $user->roles()->sync($data['roles']);
        }

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $user = $this->model->findOrFail($id);

        if ($user) {
            $user->delete();
            $user->roles()->detach();
        }
    }
}
