<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Activity;

/**
 * Class ActivityRepository
 * @package Robust\Projects\Repositories
 */
class ActivityRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * ActivityRepository constructor.
     * @param Activity $model
     */
    public function __construct(Activity $model)
    {
        $this->model = $model;
    }
}
