<?php

namespace Robust\Core\Repositories\Api;

use Robust\Core\Models\Setting;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;


/**
 * Class SettingRepository
 * @package Robust\Core\Repositories\Api
 */
class SettingRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * @var Setting
     */
    private $model;

    /**
     * SettingRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

}
