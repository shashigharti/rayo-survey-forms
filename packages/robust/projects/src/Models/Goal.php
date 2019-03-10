<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Goal
 * @package Robust\Projects\Models
 */
class Goal extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_goals';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Goal';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'assumption',
        'project_id',
        'numbering',
        'parent_id'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function indicators()
    {
        return $this->morphMany('Robust\Projects\Models\Indicator', 'indicatable');
    }

    public function assumptions()
    {
        return $this->morphMany('Robust\Projects\Models\Assumption', 'assumable');
    }

    public function getNumberNameAttribute()
    {
        return $this->numbering . ".    " . $this->name;
    }
}
