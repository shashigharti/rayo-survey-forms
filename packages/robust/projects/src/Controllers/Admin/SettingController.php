<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Projects\Repositories\ProjectRepository;
use Robust\Projects\Repositories\SettingRepository;

/**
 * Class ProjectController
 * @package Robust\Projects\Controllers\Admin
 */
class SettingController extends Controller
{
    use ViewTrait;

    public $models = ['micro_benificiary' => ['namespace' => 'Robust\Projects\Models\MicroBenificiary', 'model_name' => 'model_micro_benificiaries'],
        'organization_type' => ['namespace' => 'Robust\Projects\Models\OrganizationType', 'model_name' => 'model_organization_types'],
        'benificiary_type' => ['namespace' => 'Robust\Projects\Models\BenificiaryType', 'model_name' => 'model_benificiary_types'],
        'registration_type' => ['namespace' => 'Robust\Projects\Models\RegistrationType', 'model_name' => 'model_registration_types'],
        'mne_type' => ['namespace' => 'Robust\Projects\Models\MNEType', 'model_name' => 'model_mne_types'],

    ];

    public function __construct(
        Request $request

    )
    {
        $this->request = $request;
        $this->package_name = 'projects';
        $this->view = 'admin.permissions';
        $this->title = 'Settings';
        $this->ui = 'Robust\Projects\UI\Project';
    }

    public function store()
    {
        $model_name = $this->request->get('model');
        $model = new $model_name;
        $model->create($this->request->all());
        return redirect()->back();
    }

    public function edit($id)
    {
        $model_namespace = $this->models[$this->request->get('type')]['namespace'];
        $model_name = $this->models[$this->request->get('type')]['model_name'];
        $data = (new $model_namespace)->find($id);
        return redirect()->back()->with($model_name, $data);
    }

    public function update($id)
    {
        $model_name = $this->request->get('model');
        $data = (new $model_name)->find($id);
        $data->update($this->request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $model_name = $this->request->get('model');
        $model = (new $model_name)->find($id);
        $model->delete();
        return redirect()->back();
    }
}
