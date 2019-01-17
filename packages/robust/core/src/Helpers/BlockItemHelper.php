<?php
namespace Robust\Core\Helpers;


use Robust\Core\Models\BlockItem;
use Robust\Core\Repositories\BlockItemRepository;


/**
 * Class BlockItemHelper
 * @package Robust\Core\Helpers
 */
class BlockItemHelper
{
    /**
     * BlockItemHelper constructor.
     */
    public function __construct(BlockItemRepository $block_item)
    {
        $this->block_item = $block_item;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getBlockableBanners($id)
    {
        $blockitem = with(new BlockItem)->where([ ['blockable_type', 'Robust\Banners\Models\Banner'],['block_id', $id] ])->get();
        return $blockitem->pluck('blockable_id');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getBlockablePages($id)
    {
        $blockitem =with(new BlockItem)->where([ ['blockable_type', 'Robust\Pages\Models\Page'],['block_id', $id] ])->get();
        return $blockitem->pluck('blockable_id');
    }
}