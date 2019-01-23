<?php

namespace Robust\DynamicForms\Models;

use Robust\Core\Models\BaseModel;

/**
 * Class Form
 * @package Robust\DynamicForms\Models
 */
class Form extends BaseModel
{

    const DEFAULT_PAGE = 1;

    /**
     * @var mixed
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'dynform_forms';

    /**
     * @var string
     */
    protected $namespace = 'Robust\DynamicForms\Models\Form';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'display',
        'pages',
        'status',
        'properties',
        'field_for_user_email',
        'notify_to_user',
        'single_submit',
        'make_public'
    ];

    /**
     * @return mixed
     */
    public function datas()
    {
        return $this->hasMany('Robust\DynamicForms\Models\Data');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany('Robust\Admin\Models\User', 'dynform_form_user');
    }

}
