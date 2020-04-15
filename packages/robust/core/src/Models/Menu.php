<?php
namespace Robust\Core\Models;


/**
 * Class Menu
 * @package Robust\Core\Models
 */
class Menu extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var array
     */
    protected $fillable = [
        'display_name',
        'name',
        'package_name',
        'permission',
        'url',
        'type',
        'order',
        'icon',
        'parent_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('\Robust\Core\Models\Menu', 'parent_id');
    }
}
