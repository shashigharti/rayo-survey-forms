<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Projects\Models\Goal;
use Robust\Projects\Models\Monitoring;
use Robust\Projects\Models\Partner;
use Robust\Projects\Models\Target;
use Robust\Projects\Repositories\ActivityRepository;
use Robust\Projects\Repositories\GoalRepository;
use Robust\Projects\Repositories\OutcomeRepository;
use Robust\Projects\Repositories\OutputRepository;
use Robust\Projects\Repositories\ProjectRepository;
use Robust\Projects\Repositories\SettingRepository;

/**
 * Class ProjectController
 * @package Robust\Projects\Controllers\Admin
 */
class ProjectController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * ProjectController constructor.
     * @param Request $request
     * @param ProjectRepository $project
     */
    public function __construct(
        Request $request,
        ProjectRepository $project
    )
    {
        $this->model = $project;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Project';
        $this->package_name = 'projects';
        $this->view = 'admin.projects';
        $this->ajax_view = 'admin.ajax.projects';
        $this->title = 'Projects';
        $this->table = 'core::admin.layouts.sub-layouts.list';
        $this->child_table = 'core::admin.layouts.sub-layouts.table';

        $this->previous_url = url()->previous();
    }


    public function store(Request $request)
    {
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
        return redirect(route("admin.projects.edit", $model->id))->with('message', 'Record was successfully saved!!');
    }

    /**
     * @param $id
     * @return $this
     */
    public function logFrame(GoalRepository $goal, OutputRepository $output, OutcomeRepository $outcome, ActivityRepository $activity, $id)
    {
        $project = $this->model->find($id);
        $records['goals'] = $goal->where('project_id', $id)->get();
        $records['outcomes'] = $outcome->where('project_id', $id)->get();
        $records['outputs'] = $output->where('project_id', $id)->get();
        $records['activities'] = $activity->where('project_id', $id)->get();
        $cols = ['indicators'];

        return $this->display('projects::admin.projects.logframe',
            [
                'model' => $project,
                'records' => $records,
                'cols' => $cols,
                'child_ui' => new \Robust\Projects\UI\LogFrame
            ]
        );
    }


    /**
     * @param ProjectRepository $project
     * @param $id
     * @return $this
     */
    public function getProjectTargets(ProjectRepository $project, $id)
    {
        $project = $project->find($id);
        $records = $project->targets()->paginate();
        return $this->display($this->child_table,
            [
                'records' => $records,
                'model' => $project,
                'child' => new Target(),
                'child_ui' => new \Robust\Projects\UI\Target
            ]
        );
    }

    /**
     * @param ProjectRepository $project
     * @param $id
     * @return $this
     */
    public function getProjectPartners(ProjectRepository $project, $id)
    {
        $project = $project->find($id);
        $records = $project->partners()->paginate();
        return $this->display($this->child_table,
            [
                'records' => $records,
                'model' => $project,
                'child' => new Partner(),
                'child_ui' => new \Robust\Projects\UI\Partner
            ]
        );
    }

    /**
     * @param ProjectRepository $project
     * @param $id
     * @return $this
     */
    public function getProjectGoals(ProjectRepository $project, $id)
    {
        $project = $project->find($id);
        $records = $project->goals()->paginate();
        return $this->display($this->child_table,
            [
                'records' => $records,
                'model' => $project,
                'child' => new Goal(),
                'child_ui' => new \Robust\Projects\UI\Goal
            ]
        );
    }

    /**
     * @param ProjectRepository $project
     * @param $id
     * @return $this
     */
    public function getProjectMonitorings(ProjectRepository $project, $id)
    {
        $project = $project->find($id);
        $records = $project->monitorings()->paginate();
        return $this->display($this->child_table,
            [
                'records' => $records,
                'model' => $project,
                'child' => new Monitoring(),
                'child_ui' => new \Robust\Projects\UI\Monitoring
            ]
        );
    }

    public function getProjectPermissions(ProjectRepository $project, $id)
    {
        $model = $project->find($id);
        return $this->display('projects::admin.permissions.create',
            [
                'model' => $model,
            ]
        );
    }

    public function getProjectSetting(ProjectRepository $project, $id)
    {
        $model = $project->find($id);

        return $this->display('projects::admin.setting.create',
            [
                'model' => $model,
            ]
        );
    }

    public function getParentWiseNumbering($type, $parent_id = null)
    {
        $types = ['goals' => ['namespace' => 'Robust\Projects\Models\Goal', 'parent_field' => 'parent_id'],
            'outcomes' => ['namespace' => 'Robust\Projects\Models\Outcome', 'parent_field' => 'parent_id'],
            'outputs' => ['namespace' => 'Robust\Projects\Models\Output', 'parent_field' => 'parent_id', 'super_parent_field' => 'outcome_id'],
            'activities' => ['namespace' => 'Robust\Projects\Models\Activity', 'parent_field' => 'parent_id', 'super_parent_field' => 'output_id'],
            'indicator' => ['namespace' => 'Robust\Projects\Models\Indicator', 'parent_field' => 'indicatable_id', 'parent_type' => 'indicatable_type'],
            'assumption' => ['namespace' => 'Robust\Projects\Models\Assumption', 'parent_field' => 'assumable_id', 'parent_type' => 'assumable_type']

        ];

        if ($this->request->has('parent_id')) {
            $data = $types[$this->request->get('parent_type')]['namespace']::find($this->request->get('parent_id'));
            $max = $types[$type]['namespace']::where($types[$type]['parent_type'], $types[$this->request->get('parent_type')]['namespace'])->where($types[$type]['parent_field'], $this->request->get('parent_id'))->where('parent_id', 0)->count();
            return response()->json(['max' => $data->numbering . '-' . ($max + 1)]);
        }

        if ($this->request->has('own_parent_id')) {
            $data = $types[$type]['namespace']::find($this->request->get('own_parent_id'));
            $max = $types[$type]['namespace']::where('parent_id', $this->request->get('own_parent_id'))->count();
            return response()->json(['max' => $data->numbering . '-' . ($max + 1)]);
        }

        if ($this->request->has('super_parent_id')) {
            $data = $types[$this->request->get('parent_type')]['namespace']::find($this->request->get('super_parent_id'));
            $max = $types[$type]['namespace']::where($types[$type]['super_parent_field'], $this->request->get('super_parent_id'))->where('parent_id', 0)->count();
            return response()->json(['max' => $data->numbering . '-' . ($max + 1)]);
        }

        $max = $types[$type]['namespace']::where($types[$type]['parent_field'], '<>' . 0)->where('project_id', $parent_id)->count();
        return response()->json(['max' => $max + 1]);
    }

    public function getDataByParent($type)
    {
        $types = ['goals' => ['namespace' => 'Robust\Projects\Models\Goal', 'parent_field' => 'goal_id'],
            'outcomes' => ['namespace' => 'Robust\Projects\Models\Outcome'],
            'outputs' => ['namespace' => 'Robust\Projects\Models\Output', 'super_parent_field' => 'outcome_id'],
            'activities' => ['namespace' => 'Robust\Projects\Models\Activity', 'super_parent_field' => 'output_id'],
            'indicator' => ['namespace' => 'Robust\Projects\Models\Indicator', 'parent_id' => 'indicatable_id', 'parent_type' => 'indicatable_type']
        ];
        $indicators = $types[$type]['namespace']::where($types[$type]['super_parent_field'], $this->request->get('parent_id'))->get();

        return $indicators->toArray();
    }
}
