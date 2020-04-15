<?php

namespace Robust\DynamicForms\Repositories\Admin;

use Robust\Core\Repositories\Admin\RoleRepository;
use Robust\Core\Repositories\Admin\UserRepository;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Robust\DynamicForms\Models\Form;

/**
 * Class FormRepository
 * @package Robust\DynamicForms\Repositories
 */
class FormRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * FormRepository constructor.
     * @param Form $model
     * @param RoleRepository $role
     * @param UserRepository $user
     */
    public function __construct(Form $model, RoleRepository $role, UserRepository $user)
    {
        $this->model = $model;
        $this->role = $role;
        $this->user = $user;
    }

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
