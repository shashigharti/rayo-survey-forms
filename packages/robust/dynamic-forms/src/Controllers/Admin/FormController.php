<?php

namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\DynamicForms\Models\Form;
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
     * @param $id
     * @return $this
     */
    public function permissions($id)
    {
        $model = $this->model->find($id);
        return $this->display('dynamic-forms::admin.forms.permissions', [
            'title' => 'Permissions',
            'model' => $model,
            'ui' => 'Robust\DynamicForms\UI\Form'
        ]);

    }


    /**
     * @param $element
     * @param $name
     * @param $type
     * @return string
     */
    public function getDuplicateName($element, $name, $type)
    {
        $flag = 0;
        $temp = $name;
        $elementNull = clone $element;
        while ($element->where($type, $name)->count() != 0) {
            ++$flag;
            $name = $temp . '-copy' . $flag;
            $elementNull = clone $element;
        }

        return $name;
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
            'pages' => $form->pages,
            'status' => $form->status,
            'field_for_user_email' => $form->field_for_user_email,
            'notify_to_user' => $form->notify_to_user,
            'single_submit' => $form->single_submit,
            'make_public' => $form->make_public
        ];

        $new_data['slug'] = $this->getDuplicateName(with(new Form()), $new_data['slug'] == '' ? \Str::slug($new_data['title']) : $new_data['slug'], 'slug');
        $new_data['title'] = $this->getDuplicateName(with(new Form()), $new_data['title'], 'title');
        $new_form = $this->model->store($new_data);
        if ($form->fields->count()) {
            foreach ($form->fields as $each_field) {
                $new_field_data = array_merge($each_field->toArray(), ['form_id' => $new_form->id]);

                $this->form_field->duplicateByRelation($new_field_data);
            }
        }
        return \Redirect::back()->with(['message' => 'You have successfully duplicated a form']);
    }


    /**
     * @param Request $request
     * @param FormRepository $form
     * @param $id
     * @return string
     */
    public function postPermissions(Request $request, FormRepository $form, $id)
    {
        $roles = $request->get('roles');
        $users = $request->get('users');
        $form->roles($id, $roles);
        $form->users($id, $users);

        return 'successfully updated!';
    }

    /**
     * @param $id
     * @return mixed
     */
    public function theme($id)
    {
        $form = $this->model->find($id);
        $form->theme = $this->request->get('cls');
        $form->update();
        return \Response::json(
            'Theme successfully applied.'
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $form = $this->model->find($id);
        $form->datas()->delete();
        $form->fields()->delete();
        $form->delete($id);
        return redirect()->back()->with('message', 'Record was successfully deleted!');
    }


    /**
     * @param $id
     * @return $this
     */
    public function print_($id)
    {
        $form = $this->model->find($id);
        return $this->display('core::admin.layouts.print',
            [
                'template' => 'dynamic-forms::admin.forms.print',
                'model' => $form,
            ]
        );
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

}
