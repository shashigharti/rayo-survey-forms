<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Models\Target;
use Robust\Projects\Repositories\IndicatorRepository;

/**
 * Class IndicatorController
 * @package Robust\Projects\Controllers\Admin
 */
class IndicatorController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * IndicatorController constructor.
     * @param Request $request
     * @param IndicatorRepository $indicator
     */
    public function __construct(
        Request $request,
        IndicatorRepository $indicator
    )
    {
        $this->model = $indicator;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Indicator';
        $this->package_name = 'projects';
        $this->view = 'admin.indicators';
        $this->ajax_view = 'admin.ajax.indicators';
        $this->title = 'Indicators';
    }

    public function getParentIndicators($parent_id = null)
    {
        $types = ['goals' => ['namespace' => 'Robust\Projects\Models\Goal', 'parent_field' => 'goal_id'],
            'outcomes' => ['namespace' => 'Robust\Projects\Models\Outcome'],
            'outputs' => ['namespace' => 'Robust\Projects\Models\Output'],
            'activities' => ['namespace' => 'Robust\Projects\Models\Activity'],
            'indicator' => ['namespace' => 'Robust\Projects\Models\Indicator', 'parent_id' => 'indicatable_id', 'parent_type' => 'indicatable_type']
        ];

        if ($this->request->has('super_parent_type')) {
            if ($this->request->get('filter') == 'registration_type') {
                $super_parents = ($this->request->get('super_parent_type') != 'null') ? $this->request->get('super_parent_type') : '';
                $super_parent_arr = explode(',', $super_parents);

                $data = \Robust\Projects\Models\Indicator::where('project_id', $parent_id)->where(function ($query) use ($super_parent_arr, $types) {
                    foreach ($super_parent_arr as $each_parent) {
                        if ($each_parent != "")
                            $query->orWhere('registration', $each_parent);
                    }
                })->get();
//                return array_search(($data->toArray())['indicatable_type'], $types);
                return $data->toArray();
            }
        }

        $indicators = \Robust\Projects\Models\Indicator::where('indicatable_type', $types[$this->request->get('parent_type')]['namespace'])->where('indicatable_id', $this->request->get('parent_id'))->get(['id', 'name', 'numbering']);
        return $indicators->toArray();
    }

    public function filterByTargetGroups($parent_id = null)
    {
        $types = ['goals' => ['namespace' => 'Robust\Projects\Models\Goal', 'parent_field' => 'goal_id'],
            'outcomes' => ['namespace' => 'Robust\Projects\Models\Outcome'],
            'outputs' => ['namespace' => 'Robust\Projects\Models\Output'],
            'activities' => ['namespace' => 'Robust\Projects\Models\Activity'],
            'indicator' => ['namespace' => 'Robust\Projects\Models\Indicator', 'parent_id' => 'indicatable_id', 'parent_type' => 'indicatable_type']
        ];
        $parent_type_arr = explode(',', $this->request->get('parent_type'));
        $data = \Robust\Projects\Models\Indicator::where('project_id', $parent_id)->where(function ($query) use ($parent_type_arr) {
            foreach ($parent_type_arr as $each_parent) {
                if ($each_parent != "")
                    $query->orWhere('registration', $each_parent);
            }
        })
            ->where(function ($query) {
                return $query->where('target_id', $this->request->get('target_id'))->orWhere('target_id', '0');
            })
            ->get();

        return $data->toArray();
    }

    public function getIndicatorProperty(Request $request, $indicator_id = null)
    {
        $indicator = [];
        if ($indicator_id != null) {
            $indicator = $this->model->find($indicator_id);
        }
        $view = $request->get('type');
        return view("projects::admin.ajax.indicators.properties.$view", compact('indicator'));
    }

    public function store(Request $request)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;

        if ($request->has('referer')) {
            $this->previous_url = $request->get('referer');
        }

        $data = $request->all();
        $data['properties'] = json_encode($data['properties']);
        $rules = with(new $this->ui)->addrules;
        $this->validate($request,
            $rules
        );
        $model = $this->model->store($data);
        if (isset($this->events['store'])) {
            $event = $this->events['store'];
            event(new $event($model));
        }

        // Redirect back
        if (isset($this->previous_url)) {
            return redirect($this->previous_url)->with('message', 'Record was successfully saved!!');
        }

        return redirect(route("{$redirect}.index"))->with('message', 'Record was successfully saved!!');
    }

    public function update(Request $request, $id)
    {
        $redirect = isset($this->redirect) ? $this->redirect : $this->view;
        if ($request->has('referer')) {
            $this->previous_url = $request->get('referer');
        }

        $data = $request->all();
        $data['properties'] = json_encode($data['properties']);

        $rules = with(new $this->ui)->editrules;
        $this->validate($request,
            $rules
        );
        $model = $this->model->update($id, $data);

        if (isset($this->events['update'])) {
            $event = $this->events['update'];
            event(new $event($model));
        }

        // Redirect back
        if (isset($this->previous_url)) {
            return redirect($this->previous_url)->with('message', 'Record was successfully saved!!');
        }

        return redirect(route("{$redirect}.index"))->with('message', 'Record was successfully saved!!');
    }

}
