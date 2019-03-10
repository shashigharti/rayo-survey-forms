<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Outcome;

/**
 * Class OutcomeRepository
 * @package Robust\Projects\Repositories
 */
class OutcomeRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait;

    /**
     * OutcomeRepository constructor.
     * @param Outcome $model
     */
    public function __construct(Outcome $model)
    {
        $this->model = $model;
    }
}
