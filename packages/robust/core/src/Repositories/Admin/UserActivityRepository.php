<?php

namespace Robust\Admin\Repositories\Admin;

use Robust\Admin\Models\UserActivity;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;


/**
 * Class UserActivityRepository
 * @package Robust\Admin\Repositories\Admin
 */
class UserActivityRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * @var UserActivity
     */
    protected $model;

    /**
     * UserActivityRepository constructor.
     * @param UserActivity $model
     */
    public function __construct(UserActivity $model)
    {
        $this->model = $model;
    }
}
