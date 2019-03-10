<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 * @package Robust\Projects\Models
 */
class Activity extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_activities';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Activity';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'assumption',
        'type',
        'properties',
        'project_id',
        'output_id',
        'type',
        'partner_id',
        'start_date',
        'end_date',
        'numbering',
        'parent_id'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_date',
        'end_date'
    ];

    /**
     * @param $value
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    /**
     * @param $value
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function indicators()
    {
        return $this->morphMany('Robust\Projects\Models\Indicator', 'indicatable');
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return ['Other' => 'Other', 'Activity' => 'Activity', 'Training' => 'Training'];
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
