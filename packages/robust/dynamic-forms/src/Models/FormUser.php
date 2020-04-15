<?php

namespace Robust\DynamicForms\Models;

use Robust\Core\Models\BaseModel;

/**
 * Class Form
 * @package Robust\DynamicForms\Models
 */
class FormUser extends BaseModel
{

    /**
     * @var mixed
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'dynform_form_user';

    /**
     * @var string
     */
    protected $namespace = 'Robust\DynamicForms\Models\FormUser';

    /**
     * @var array
     */
    protected $fillable = [
        'form_id',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forms()
    {
        return $this->belongsToMany('Robust\DynamicForms\Models\Form', 'dynform_forms');
    }

}
