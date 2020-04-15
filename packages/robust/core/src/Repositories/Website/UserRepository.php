<?php


namespace Robust\Core\Repositories\Website;


use Robust\Core\Models\User;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;

/**
 * Class RegisterRepository
 * @package Robust\Core\Repositories\Website
 */
class UserRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * @var User
     */
    protected $model;

    /**
     * RegisterRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
