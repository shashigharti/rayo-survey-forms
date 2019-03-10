<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Robust\Projects\Models\Project;
use Robust\Projects\Repositories\ProjectRepository;

/**
 * Class ProjectController
 * @package Robust\Projects\Controllers\Admin
 */
class PermissionController extends Controller
{
    public function __construct(
        Request $request
    )
    {
        $this->request = $request;
        $this->package_name = 'projects';
        $this->view = 'admin.permissions';
        $this->title = 'Permissions';
    }

    public function getProjectPermissions(ProjectRepository $project, $id)
    {
        $model = $project->find($id);
        return view("projects::{$this->view}.create", compact('model'));
    }


    public function store(ProjectRepository $project, Request $request)
    {
        $users = $request->get('users');
        $id = $request->get('project_id');

        if($users == null)
            $users = [];
//        dd($users);
        $project->users($id, $users);
        return redirect()->back()->with('message', 'User(s) has meen permittd to use the project');
    }
}
