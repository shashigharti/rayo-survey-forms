<?php

namespace Robust\Core\Repositories\Admin;

use Illuminate\Support\Facades\Hash;
use Robust\Core\Models\Role;
use Robust\Core\Models\User;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;

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
