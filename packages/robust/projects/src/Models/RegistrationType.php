<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicator
 * @package Robust\Projects\Models
 */
class RegistrationType extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_registration_types';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\RegistrationType';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'description',
        'project_id'
    ];

}
