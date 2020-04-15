<?php

namespace Robust\Core\Models;


/**
 * Class User
 * @package Robust\Admin\Models
 */
class Admin extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'contact',
        'address',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function user()
    {
        return $this->morphOne('Robust\Core\Models\User', 'memberable');
    }
}
