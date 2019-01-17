<?php
namespace Robust\Core\Repositories;

use Robust\Core\Models\Report;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;

/**
 * Class ReportRepository
 * @package Robust\Core\Repositories
 */
class ReportRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * ReportRepository constructor.
     * @param Report $report
     */
    public function __construct(Report $report)
    {
        $this->model = $report;
    }
}