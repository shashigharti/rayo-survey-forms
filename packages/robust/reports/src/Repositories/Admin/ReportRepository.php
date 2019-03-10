<?php
namespace Robust\Reports\Repositories\Admin;

use Robust\Admin\Repositories\Admin\RoleRepository;
use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Reports\Models\Report;

/**
 * Class ReportRepository
 * @package Robust\Reports\Repositories
 */
class ReportRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    public function __construct(Report $model)
    {
        $this->model = $model;
    }
}
