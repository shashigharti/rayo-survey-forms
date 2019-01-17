<?php

namespace Robust\Admin\Repositories\Admin;

use Illuminate\Notifications\Notifiable;
use Robust\Admin\Models\Role;
use Robust\Admin\Models\User;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;

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