<?php

namespace Robust\Core\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Repositories\Admin\CommandRepository;


/**
 * Class CommandController
 * @package Robust\Core\Controllers\Admin
 */
class CommandController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * CommandController constructor.
     * @param CommandRepository $command
     * @return void
     */
    public function __construct(CommandRepository $command)
    {
        $this->model = $command;
        $this->ui = 'Robust\Core\UI\Command';
        $this->package_name = 'core';
        $this->view = 'admin.commands';
        $this->title = 'Commands';
    }

    public function run($id)
    {
        $task = $this->model->find($id);
        //Artisan::run($task->command);
    }
}