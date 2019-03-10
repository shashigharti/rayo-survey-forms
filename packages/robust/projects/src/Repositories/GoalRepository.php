<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Goal;

/**
 * Class GoalRepository
 * @package Robust\Projects\Repositories
 */
class GoalRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    

    /**
     * GoalRepository constructor.
     * @param Goal $model
     */
    public function __construct(Goal $model)
    {
        $this->model = $model;
    }
}
