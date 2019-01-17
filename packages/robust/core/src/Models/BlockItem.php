<?php
namespace Robust\Core\Models;


/**
 * Class BlockItem
 * @package Robust\Core\Models
 */
class BlockItem extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'blocks_items';


    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\BlockItem';

    /**
     * @var array
     */
    protected $fillable = [
        'block_id',
        'blockable_id',
        'blockable_type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function blockable()
    {
        return $this->morphToMany('Robust\Core\Models\BlockItems', 'blocks', 'blockable_id', 'block_id');
    }

}
