<?php

namespace Robust\Admin\Repositories\Admin;

use Illuminate\Support\Facades\Hash;
use Robust\Admin\Models\Role;
use Robust\Admin\Models\User;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;

/**
 * Class ProfileRepository
 * @package Robust\Admin\Repositories\Admin
 */
class ProfileRepository
{

    use CrudRepositoryTrait, SearchRepositoryTrait;

    /**
     * @var User
     */
    private $users;

    /**
     * @var Role
     */
    private $roles;


    public function __construct(User $profile)
    {
        $this->model = $profile;
    }

    /**
     * @param $data
     * @param $id
     */
    public function update($data, $id)
    {
        $profile = $this->model->findOrFail($id);
        (isset($data['password'])) ? $data['password'] = Hash::make($data['password']): '';

        if ($profile) {
            $profile->update($data);
        }
    }

}