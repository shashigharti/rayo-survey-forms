<?php

namespace Robust\Core\Repositories;

use Robust\Core\Models\Schedule;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;


/**
 * Class SchedulesRepository
 * @package Robust\Core\Repositories
 */
class SchedulesRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * SchedulesRepository constructor.
     * @param Schedule $model
     */
    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

}
