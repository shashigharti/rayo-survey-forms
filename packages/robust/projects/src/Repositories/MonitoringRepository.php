<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\PivotRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Monitoring;

/**
 * Class MonitoringRepository
 * @package Robust\Projects\Repositories
 */
class MonitoringRepository
{
    use PivotRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    
    protected $relation = [
        'indicators' => 'indicator_ids'
    ];


    /**
     * MonitoringRepository constructor.
     * @param Monitoring $model
     */
    public function __construct(Monitoring $model)
    {
        $this->model = $model;
    }
}
