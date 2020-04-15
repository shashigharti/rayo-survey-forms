<?php

namespace Robust\DynamicForms\Controllers\Admin\Ajax;

use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Controller;
use Robust\DynamicForms\Repositories\Admin\FormRepository;

/**
 * Class FormController
 * @package Robust\DynamicForms\Controllers\Admin\Ajax
 */
class FormController extends Controller
{
    use CrudTrait;

    public function __construct(
        FormRepository $model
    )
    {
        $this->model = $model;
    }
}
