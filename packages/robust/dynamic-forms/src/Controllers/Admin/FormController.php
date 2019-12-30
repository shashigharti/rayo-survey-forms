<?php

namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\Core\Helpers\MenuHelper;
use Robust\DynamicForms\Models\Form;
use Robust\DynamicForms\Models\FormUser;
use Robust\DynamicForms\Repositories\Admin\FormRepository;

/**
 * Class FormController
 * @package Robust\DynamicForms\Controllers\Admin
 */
class FormController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * FormController constructor.
     * @param Request $request
     * @param FormRepository $model
     */
    public function __construct(
        Request $request,
        FormRepository $model
    )
    {
        $this->request = $request;
        $this->model = $model;
        $this->ui = 'Robust\DynamicForms\UI\Form';
        $this->package_name = 'dynamic-forms';
        $this->view = 'admin.forms';
        $this->title = 'Forms';
    }


    /**
     * @param \Robust\DynamicForms\Models\FormUser $formUser
     * @return \Robust\DynamicForms\Controllers\Admin\FormController
     */
    public function index(FormUser $formUser)
    {
        // Get accessible forms ids for the current user
        $forms_available = $formUser->select('form_id')->where('user_id', Auth::id())->get();

        // If super user display all forms
        if(Auth::id() == 1) {
            $records = $this->model->paginate();
        } else {
            // Display the forms the user has been given access to
            $records = $this->model->whereIn('id', $forms_available)->paginate();
        }

        return $this->display($this->table,
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name),
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $this->package_name,
            ]
        );
    }


    /**

     * @param $form_id
     * @return $this
     */
    public function design($form_id)
    {
        $form = $this->model->find($form_id);

        return $this->display('dynamic-forms::admin.forms.design', [
            'title' => 'Design',
            'form' => $form,
            'model' => $form,
            'ui' => 'Robust\DynamicForms\UI\Form'
        ]);
    }

    /**
     * @param $form_id
     * @return mixed
     */
    public function duplicate($form_id)
    {
        $form = $this->model->find($form_id);

        $new_data = [
            'slug' => $form->slug,
            'title' => $form->title,
            'status' => $form->status,
            'field_for_user_email' => $form->field_for_user_email,
            'notify_to_user' => $form->notify_to_user,
            'single_submit' => $form->single_submit,
            'make_public' => $form->make_public,
            'user_id' => Auth::user()->id
        ];

        $new_data['slug'] = $this->getDuplicateName($new_data['slug']);
        $new_data['title'] = ucwords(str_replace('-', ' ', $new_data['slug']));
        $new_form = $this->model->store($new_data);
        return \Redirect::back()->with(['message' => 'You have successfully duplicated a form']);
    }

    /**
     * @param $slug
     * @return string|null
     */
    public function getDuplicateName($slug)
    {
        $slugs = $this->model->where('slug','%' .$slug . '%','like')
                ->pluck('slug')->toArray();
        $counter = 1;
        $result = null;
        do{
            $result = $slug . '-duplicate-' .$counter;
            $counter+=1;
        }while(in_array($result,$slugs));
        return $result;
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $form = $this->model->find($id);
        $form->datas()->delete();
        $form->delete($id);
        return redirect()->back()->with('message', 'Record was successfully deleted!');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function preview(Request $request, $id)
    {
        parse_str($request->getQueryString(), $query_params);
        $model = $this->model->find($id);

        return $this->display("{$this->package_name}::{$this->view}.preview", [
                'model' => $model,
                'query_params' => $query_params
            ]
        );
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @param \Robust\DynamicForms\Models\Form $form
     * @param \App\User $user
     * @return \Robust\DynamicForms\Controllers\Admin\FormController
     */
    public function permissions(Request $request, $id, Form $form, User $user)
    {
        parse_str($request->getQueryString(), $query_params);

        // Array of all users except super admin
        $all_users = $user->where('id', '!=', 1)->get()->toArray();

        // Array of permitted users to the form
        $permitted_users = [];
        foreach($form->find($id)->users as $user) {
            array_push($permitted_users, $user->toArray());
        }

        // Mapping both all users and permitted users into an array
        $users = array_map(function($user) {
            return [$user['id'], $user['first_name'], $user['last_name']];
        }, $all_users);
        $p_users = array_map(function($user) {
            return [$user['id'], $user['first_name'], $user['last_name']];
        }, $permitted_users);

        // Get the difference between two array
        $unpermitted_users = array_diff(array_map('json_encode', $users), array_map('json_encode', $p_users));
        // Json decode the result
        $unpermitted_users = array_map('json_decode', $unpermitted_users);

        return $this->display("{$this->package_name}::{$this->view}.permissions", [
                'all_users' => $all_users,
                'permitted_users' => $permitted_users,
                'unpermitted_users' => $unpermitted_users,
                'form_id' => $id
            ]
        );
    }

}
