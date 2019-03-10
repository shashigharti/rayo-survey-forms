<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\PivotRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Monitoring;
use Robust\Projects\Models\Setting;

/**
 * Class MonitoringRepository
 * @package Robust\Projects\Repositories
 */
class SettingRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * MonitoringRepository constructor.
     * @param Monitoring $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
}
