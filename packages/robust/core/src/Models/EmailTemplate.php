<?php


namespace Robust\Core\Models;


/**
 * Class EmailTemplate
 * @package Robust\Core\Models
 */
class EmailTemplate extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'email_templates';

    /**
     * @var array
     */
    public $searchable = ['name'];
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'template',
        'type',
        'subject',
        'body',
        'editable',
        'removable'
    ];
}
