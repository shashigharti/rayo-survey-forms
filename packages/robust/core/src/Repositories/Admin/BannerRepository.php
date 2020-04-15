<?php
namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\Banner;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;


/**
 * Class BannerRepository
 * @package Robust\Core\Repositories\Admin
 */
class BannerRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * BannerRepository constructor.
     * @param Banner $backup
     */
    public function __construct(Banner $backup)
    {
        $this->model = $backup;
    }
}
