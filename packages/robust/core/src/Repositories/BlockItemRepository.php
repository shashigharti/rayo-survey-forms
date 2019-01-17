<?php
namespace Robust\Core\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Core\Repositories\Traits\PolyMorphRepositoryTrait;
use Robust\Core\Models\BlockItem;


/**
 * Class BlockItemRepository
 * @package Robust\Core\Repositories
 */
class BlockItemRepository
{
    use PolyMorphRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * BlockItemRepository constructor.
     * @param BlockItem $model
     */
    public function __construct(BlockItem $model)
    {
        $this->model = $model;
    }
}