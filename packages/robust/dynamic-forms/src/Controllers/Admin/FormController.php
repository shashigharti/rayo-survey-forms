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
        return \Redirect::back()->with(['message' => 'You have successfully duplicated a form']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
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

}
