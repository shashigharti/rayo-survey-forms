<?php
namespace Robust\Core\Repositories;

use Robust\Admin\Models\User;
use Robust\Core\Models\Widget;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;

/**
 * Class WidgetRepository
 * @package Robust\Core\Repositories
 */
class WidgetRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * WidgetRepository constructor.
     * @param User $user
     * @param Widget $widget
     */
    public function __construct(User $user, Widget $widget)
    {
        $this->model = $widget;
        $this->user = $user;
    }
}