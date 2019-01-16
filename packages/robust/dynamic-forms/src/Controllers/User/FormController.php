<?php
namespace Robust\DynamicForms\Controllers\User;

use App\Http\Controllers\Controller;
use Robust\DynamicForms\Repositories\Admin\FormRepository;


/**
 * Class FormController
 * @package Robust\DynamicForms\Controllers\Admin
 */
class FormController extends Controller
{
    public function __construct(FormRepository $model)
    {
        $this->model = $model;
    }

    public function show($slug)
    {
        $model = $this->model->where('slug', $slug)->first();
        if ($model->make_public == 1 && $model->status == 1)
            return view('dynamic-forms::user.form.view', compact('model'));
        else
            return view('core::user.404');
    }
}
