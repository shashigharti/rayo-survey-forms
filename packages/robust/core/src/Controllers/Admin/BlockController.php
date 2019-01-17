<?php
namespace Robust\Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\BlockRepository;
use Robust\Banners\Models\Banner;
use Robust\Pages\Models\Page;

/**
 * Class BlockController
 * @package Robust\Core\Controllers\Admin
 */
class BlockController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * BlockController constructor.
     * @param Request $request
     * @param BlockRepository $blocks
     */
    public function __construct(Request $request, BlockRepository $blocks)
    {

        $this->model = $blocks;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Block';
        $this->package_name = 'core';
        $this->view = 'admin.block';
        $this->title = 'Blocks';
        $this->redirect = 'admin.theme-block';
    }


    /**
     * @param BlockRepository $block
     * @param $block_id
     * @return $this
     */
    public function getBanners(BlockRepository $block, $block_id)
    {
        $model = $block->find($block_id);
        $records = Banner::all();
        return $this->display("core::admin.block.partials.banners",
            [
                'title' => 'Banners',
                'records' => $records,
                'package' => $this->package_name,
                'model' => $model,
                'child_ui' => new \Robust\Core\UI\Banner,
            ]);
    }

    /**
     * @param BlockRepository $block
     * @param $block_id
     * @return $this
     */
    public function getPages(BlockRepository $block, $block_id)
    {
        $model = $block->find($block_id);
        $records = Page::all();
        return $this->display("core::admin.block.partials.pages",
            [
                'title' => 'Pages',
                'records' => $records,
                'package' => $this->package_name,
                'model' => $model,
                'child_ui' => new \Robust\Core\UI\Page,
            ]);

    }


}
