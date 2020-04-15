<?php
namespace Robust\Core\Models;


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
        return $this->belongsToMany('Robust\Core\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('Robust\Core\Models\Permission');
    }

}
