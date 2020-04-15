<?php
namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\Page;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;


/**
 * Class PageRepository
 * @package Robust\Core\Repositories\Admin
 */
class PageRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * @var Page
     */
    protected $model;
    /**
     * PageRepository constructor.
     * @param Page $backup
     */
    public function __construct(Page $backup)
    {
        $this->model = $backup;
    }
}
