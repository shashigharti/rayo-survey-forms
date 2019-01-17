<?php
namespace Robust\Core\Repositories;

use Robust\Core\Models\Backup;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;

/**
 * Class ReportRepository
 * @package Robust\Core\Repositories
 */
class BackupRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * ReportRepository constructor.
     * @param Report $report
     */
    public function __construct(Backup $backup)
    {
        $this->model = $backup;
    }
}