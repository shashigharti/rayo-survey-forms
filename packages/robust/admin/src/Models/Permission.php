<?php
namespace Robust\Admin\Models;

use Robust\Core\Models\BaseModel;

/**
 * Class Permission
 * @package Robust\Admin\Models
 */
class Permission extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Robust\Admin\Models\Role');
    }

}
