<?php
namespace Robust\Projects\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Projects\Models\Partner;

/**
 * Class PartnerRepository
 * @package Robust\Projects\Repositories
 */
class PartnerRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * PartnerRepository constructor.
     * @param Partner $model
     */
    public function __construct(Partner $model)
    {
        $this->model = $model;
    }
}
