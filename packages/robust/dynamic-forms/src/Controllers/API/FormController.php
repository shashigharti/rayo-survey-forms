<?php

namespace Robust\DynamicForms\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\DynamicForms\Helpers\FormHelper;
use Robust\DynamicForms\Models\Data;
use Robust\DynamicForms\Models\Form;
use Robust\DynamicForms\Repositories\Admin\FormRepository;

/**
 * Class FormController
 * @package Robust\DynamicForms\Controllers\API
 */
class FormController extends Controller
{
    /**
     * @param Request $request
     * @param FormHelper $helper
     * @param FormRepository $form
     * @param Data $data
     * @return array
     */
    public function data(Request $request, FormHelper $helper, FormRepository $form, Data $data)
    {
        $slug = $request->get('slug');
        $form = $form->where('slug', '=', $slug)->get()->first();
        $dimensions = [];
        $measures = [];
        $data = [];
        if (isset($form)) {
            return (isset($data) ? ['data' => $data, 'fields' => $dimensions, 'measures' => $measures] : []);
        }

        return [];
    }

}
