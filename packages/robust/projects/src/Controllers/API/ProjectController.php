<?php

namespace Robust\Projects\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Projects\Models\Project;
use Robust\Projects\Repositories\ProjectRepository;

/**
 * Class ProjectController
 * @package Robust\Projects\Controllers\Admin
 */
class ProjectController extends Controller
{
    /**
     * @param ProjectRepository $project
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(ProjectRepository $project)
    {
        return response()->json(['view' => Project::all()]);
    }
}
