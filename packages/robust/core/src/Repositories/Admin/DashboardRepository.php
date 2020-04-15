<?php
namespace Robust\Core\Repositories\Admin;

use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;
use Robust\Core\Models\Dashboard;

/**
 * Class DashboardRepository
 * @package Robust\Core\Repositories
 */
class DashboardRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * DashboardRepository constructor.
     * @param Dashboard $model
     */
    public function __construct(Dashboard $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->paginate(settings('app-setting', 'pagination'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return bool
     */
    public function update($data)
    {
        return $this->model->update($data);
    }

    /**
     * @param $data
     */
    public function addWidgets($data)
    {
        $dashboard = $this->model->find($data['dashboard_id']);
        $widget_ids = isset($data['widget_id'])?$data['widget_id']:[];
        $dashboard->widgets()->sync($widget_ids);
    }
}
