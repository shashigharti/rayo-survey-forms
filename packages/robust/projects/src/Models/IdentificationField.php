<?php
namespace Robust\Projects\Models;

use Robust\Core\Models\BaseModel;

/**
 * Class Goal
 * @package Robust\Projects\Models
 */
class IdentificationField extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'project_benificiary_identification_fields';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\IdentificationField';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'type',
        'order',
        'target_id'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
