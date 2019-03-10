<?php

namespace Robust\Projects\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Ajax\Traits\CrudTrait;
use Robust\Projects\Repositories\ProjectRepository;

/**
 * Class ProjectController
 * @package Robust\Projects\Controllers\Admin\Ajax
 */
class ProjectController extends Controller
{
    use CrudTrait;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $model
     */
    public function __construct(
        ProjectRepository $model
    )
    {
        $this->model = $model;
    }
}
