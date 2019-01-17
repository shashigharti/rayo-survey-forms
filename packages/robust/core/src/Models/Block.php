<?php
namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Robust\Core\Models\BaseModel;

/**
 * Class Block
 * @package Robust\Core\Models
 */
class Block extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'blocks';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    public $searchable=['name','slug','description'];

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Block';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status',
        'column'

    ];

    /**
     * @return string
     */
    public function getPackageName()
    {
        return 'core';
    }


    /**
     * @return string
     */
    public function getUI()
    {
        return 'Robust\Core\UI\Block';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function blockable()
    {
        return $this->morphToMany('Robust\Core\Models\Block', 'blocks_items', 'block_id', 'blockable_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function pages()
    {
        return $this->morphedByMany('Robust\Pages\Models\Page', 'blocks_items');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function banners()
    {
        return $this->morphedByMany('Robust\Banners\Models\Banner', 'blocks_items');
    }

}
