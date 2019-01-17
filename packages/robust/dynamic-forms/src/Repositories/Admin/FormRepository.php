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
     */
    public function store_design($data)
    {
        $form = $data['form_data'];
        $form_to_save = $this->model->find($form['id']);
        $form_to_save->title = $form['title'];
        $form_to_save->slug = \Str::slug($form['title']);
        $form_to_save->form_group_id = $form['group_id'];

        $form_to_save->save();
    }

    /**
     * @return mixed
     */
    public function getForms()
    {
        $forms = $this->model->all();
        return $forms;
    }

    /**
     * @param $criteria
     * @return mixed
     */
    public function findByCriteria($criteria)
    {
        $where = (is_numeric($criteria)) ? 'id' : 'slug';

        if (\Auth::user() && \Auth::user()->can('edit_dynamic_forms')) {
            return $this->model->withTrashed()->where($where, $criteria)
                ->first();
        }

        return $this->model
            ->where($where, $criteria)
            ->first();
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
