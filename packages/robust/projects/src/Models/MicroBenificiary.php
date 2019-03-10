<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicator
 * @package Robust\Projects\Models
 */
class MicroBenificiary extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_micro_benificiaries';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\MicroBenificiary';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'description',
        'project_id'
    ];

}
