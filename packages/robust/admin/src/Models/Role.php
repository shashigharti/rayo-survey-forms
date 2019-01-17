<?php
namespace Robust\Admin\Models;

use Robust\Core\Models\BaseModel;

/**
 * Class Role
 * @package Robust\Admin\Models
 */
class Role extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'permissions',
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Robust\Admin\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('Robust\Admin\Models\Permission');
    }

}
