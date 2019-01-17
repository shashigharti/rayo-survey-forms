<?php

namespace Robust\Core\Controllers\Admin;

use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\EmailSettingRepository;

/**
 * Class EmailSettingController
 * @package Robust\Core\Controllers\Admin
 */
class EmailSettingController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * EmailSettingController constructor.
     * @param EmailSettingRepository $model
     */
    public function __construct(Request $request, EmailSettingRepository $model)
    {
        $this->model = $model;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\EmailSetting';
        $this->package_name = 'core';
        $this->view = 'admin.email-settings';
        $this->title = 'Email Settings';
        $this->redirect = 'admin.email-settings';
    }


}