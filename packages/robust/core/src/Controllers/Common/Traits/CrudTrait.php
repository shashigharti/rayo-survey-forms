<?php

namespace Robust\Core\Controllers\Common\Traits;

use Illuminate\Http\Request;
use Robust\Core\Helpage\Site;
use Robust\Core\Helpers\MenuHelper;
use Robust\DynamicForms\Models\Form;

trait CrudTrait
{
    /**
     * @var string
     */
    private $table = 'core::admin.layouts.sub-layouts.table';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $this->model;
        if ($request->has('type') && $request->has('keyword')) {
            $type = $request->get('type');
            $keyword = $request->get('keyword');
            $query = $query->where($type, "%" . $keyword . "%", 'LIKE');
        }
        $pagination = settings('app-setting','pagination');
        $records = $query->paginate($pagination != '' ? $pagination : 10);
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        parse_str($request->getQueryString(), $query_params);
        $model = $this->model->getModel();

        return $this->display(Site::templateResolver("{$this->package_name}::{$this->view}.create"), [
            'model' => $model,
            'query_params' => $query_params
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;
        $this->model->delete($id);
        return redirect()->back()->with('message', 'Record was successfully deleted!');
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        parse_str($request->getQueryString(), $query_params);
        $model = $this->model->find($id);

        return $this->display(Site::templateResolver("{$this->package_name}::{$this->view}.create"), [
                'model' => $model,
                'query_params' => $query_params
            ]
        );
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;

        if ($request->has('referer')) {
            $this->previous_url = $request->get('referer');
        }

        $data = $request->all();
        $rules = with(new $this->ui)->addrules;
        $this->validate($request,
            $rules
        );
        $model = $this->model->store($data);
        if (isset($this->events['store'])) {
            $event = $this->events['store'];
            event(new $event($model));
        }

        // Redirect back
        if (isset($this->previous_url)) {
            return redirect($this->previous_url)->with('message', 'Record was successfully saved!!');
        }

        return redirect(route("{$redirect}.index"))->with('message', 'Record was successfully saved!!');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;
        if ($request->has('referer')) {
            $this->previous_url = $request->get('referer');
        }

        $data = $request->all();
        $rules = with(new $this->ui)->editrules;
        $this->validate($request,
            $rules
        );
        $model = $this->model->update($id, $data);

        if (isset($this->events['update'])) {
            $event = $this->events['update'];
            event(new $event($model));
        }

        // Redirect back
        if (isset($this->previous_url)) {
            return redirect($this->previous_url)->with('message', 'Record was successfully saved!!');
        }

        return redirect(route("{$redirect}.index"))->with('message', 'Record was successfully saved!!');
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $params = $request->except('_token');
        $records = $this->model->search($params);
        return $this->display($this->table,
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name)
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus($id)
    {
        $this->model->toggleStatus($id);
        return redirect()->back()->with('message', 'Successfully Updated!');

    }

    /**
     * @param $id
     * @return mixed
     */
    public function show(Request $request, $id)
    {
        parse_str($request->getQueryString(), $query_params);
        $model = $this->model->find($id);

        return $this->display("{$this->package_name}::{$this->view}.show", [
                'model' => $model,
                'query_params' => $query_params
            ]
        );
    }

}
