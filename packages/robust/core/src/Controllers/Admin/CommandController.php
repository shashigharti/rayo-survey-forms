<?php

namespace Robust\Core\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\CommandRepository;


/**
 * Class CommandController
 * @package Robust\Core\Controllers\Admin
 */
class CommandController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * CommandController constructor.
     * @param Request $request
     * @param CommandRepository $command
     */
    public function __construct(Request $request, CommandRepository $command)
    {
        $this->model = $command;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Command';
        $this->package_name = 'core';
        $this->view = 'admin.commands';
        $this->title = 'Commands';
    }

    /**
     *
     */
    public function getCommand()
    {
        Artisan::queue('robust:reset-menu');


    }
}