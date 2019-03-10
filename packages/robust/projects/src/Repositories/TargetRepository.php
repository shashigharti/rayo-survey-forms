<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\IdentificationField;
use Robust\Projects\Models\Target;

/**
 * Class TargetRepository
 * @package Robust\Projects\Repositories
 */
class TargetRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * TargetRepository constructor.
     * @param Target $model
     */
    public function __construct(Target $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        $data['micro_beneficiaries'] = json_encode($data['micro_beneficiaries']);

        $model = $this->model->create($data);
        if (isset($data['identification_fields'])) {
            foreach ($data['identification_fields'] as $each) {
                $type = explode('&&', $each);
                IdentificationField::create([
                    'name' => $type[0],
                    'type' => $type[1],
                    'order' => $type[2],

                    'target_id' => $model->id
                ]);
            }
        }
        return $model;
    }

    public function update($id, $data)
    {
        $data['micro_beneficiaries'] = json_encode($data['micro_beneficiaries']);
        $model = $this->model->find($id);
        IdentificationField::where('target_id', $id)->delete();
        $update = $this->model->find($id)->update($data);

        if (isset($data['identification_fields'])) {
            foreach ($data['identification_fields'] as $each) {
                $type = explode('&&', $each);
                IdentificationField::create([
                    'name' => $type[0],
                    'type' => $type[1],
                    'order' => $type[2],
                    'target_id' => $model->id
                ]);
            }
        }

        return $update;
    }
}
