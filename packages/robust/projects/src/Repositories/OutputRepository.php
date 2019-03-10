<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Outcome;
use Robust\Projects\Models\Outcomes;
use Robust\Projects\Models\Output;

/**
 * Class OutputRepository
 * @package Robust\Projects\Repositories
 */
class OutputRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * OutputRepository constructor.
     * @param Output $model
     */
    public function __construct(Output $model)
    {
        $this->model = $model;
    }
}
