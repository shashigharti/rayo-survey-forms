<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Project;

/**
 * Class ProjectRepository
 * @package Robust\Projects\Repositories
 */
class ProjectRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * ProjectRepository constructor.
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        $this->model = $model;
    }


    /**
     * @param $id
     * @param $users
     */
    public function users($id, $users)
    {
        $this->model->find($id)->users()->sync($users);
    }

    /**
     * @param $data
     * @return Project
     */
    public function store($data)
    {
        $model = $this->model->create($data);

        \DB::table('project_micro_benificiaries')->insert([
            [
                'name' => 'Male',
                'description' => 'Male',
                'project_id' => $model->id
            ],
            [
                'name' => 'Female',
                'description' => 'Female',
                'project_id' => $model->id
            ]
        ]);

        \DB::table('project_organization_types')->insert([
            [
                'name' => 'Non Governmental Organization NGO',
                'description' => 'Non Governmental Organization NGO',
                'project_id' => $model->id
            ],
            [
                'name' => 'Non-Profit Organization',
                'description' => 'Non-Profit Organization',
                'project_id' => $model->id
            ],
            [
                'name' => 'Government Organization',
                'description' => 'Government Organization',
                'project_id' => $model->id
            ],
            [
                'name' => 'Multilateral Organization',
                'description' => 'Multilateral Organization',
                'project_id' => $model->id
            ],
            [
                'name' => 'Company',
                'description' => 'Company',
                'project_id' => $model->id
            ]
        ]);

        \DB::table('project_benificiary_types')->insert([
            [
                'name' => 'Individual',
                'description' => 'Individual',
                'project_id' => $model->id
            ],
            [
                'name' => 'Family',
                'description' => 'Family',
                'project_id' => $model->id
            ],
            [
                'name' => 'Extended Family',
                'description' => 'Extended Family',
                'project_id' => $model->id
            ],
            [
                'name' => 'Community',
                'description' => 'Community',
                'project_id' => $model->id
            ],
            [
                'name' => 'Enterprise',
                'description' => 'Enterprise',
                'project_id' => $model->id
            ]
        ]);

        \DB::table('project_registration_types')->insert([
            [
                'name' => 'Programme Level',
                'description' => 'Programme level: one (periodic) measurement for the whole programme',
                'project_id' => $model->id
            ],
            [
                'name' => 'Team Level',
                'description' => 'Team level: measurements of different teams can be aggregated on programme level',
                'project_id' => $model->id
            ],
            [
                'name' => 'Benificiary Level',
                'description' => 'Beneficiary level: information is measured with the/a sample of benefifiaries and then aggregated',
                'project_id' => $model->id
            ]
        ]);

        \DB::table('project_mne_types')->insert([
            [
                'name' => 'Process Monitoring',
                'description' => 'Process Monitoring',
                'project_id' => $model->id
            ],
            [
                'name' => 'Impact Monitoring',
                'description' => 'Impact Monitoring',
                'project_id' => $model->id
            ]
        ]);
        return $model;
    }
}
