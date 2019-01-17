<?php
namespace Robust\Core\Repositories;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\Core\Repositories\Traits\PolyMorphRepositoryTrait;
use Robust\Core\Models\Block;
use Robust\Banners\Models\Banner;
use Robust\Pages\Models\Page;
use Robust\Core\Models\BlockItem;

/**
 * Class BlockRepository
 * @package Robust\Core\Repositories
 */
class BlockRepository
{
    use PolyMorphRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;


    /**
     * @var array
     */
    protected $morphed = [
        'banners' => 'blocks_items',
        'pages' => 'blocks_items',
    ];


    /**
     * @var array
     */
    protected $poly_morph = [
        'blocks_items' => ['id' => 'blockable_id', 'type' => 'blockable_type']
    ];




    /**
     * @var arrayc
     */
    protected $morphable = [
        'banners' => Banner::class,
        'pages' => Page::class,
    ];


    /**
     * @param $data
     * @return static
     */
    public function store($data)
    {
        $model = $this->model->create($data);
        return $model;
    }


    /**
     * @param $id
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, $data)
    {
        if(array_key_exists('morphable_id', $data))
        {
            $morphable_id = $data['morphable_id'];
            $morphable_type = $data['morphable_type'];
            $morphable = $this->morphable[$morphable_type]::find($morphable_id);

            foreach($morphable as $key=>$value)
            {
                BlockItem::updateOrCreate([
                    'block_id' => $id,
                    'blockable_id' => $value->id,
                    'blockable_type' => $this->morphable[$morphable_type],

                ]);

            }
            return redirect(route("admin.theme-block.index"))->with('message', 'Saved!!');
        }
        else
        {
            return $this->model->find($id)->update($data);
        }


    }


    /**
     * BlockRepository constructor.
     * @param Block $model
     */
    public function __construct(Block $model)
    {
        $this->model = $model;
    }
}
