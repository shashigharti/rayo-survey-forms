<?php
namespace Robust\Projects\Models;

use Carbon\Carbon;
use Robust\Core\Models\BaseModel;

/**
 * Class Project
 * @package Robust\Projects\Models
 */
class Project extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'projects';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Project';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'slug',
        'code',
        'type',
        'description',
        'status',
        'address',
        'period',
        'start_date',
        'end_date',
        'thumbnail'
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
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }


    /**
     * @param $value
     * @return string
     */
    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * @param $value
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }


    /**
     * @param $value
     * @return string
     */
    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function targets()
    {
        return $this->hasMany('Robust\Projects\Models\Target', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany('Robust\Projects\Models\Goal', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outputs()
    {
        return $this->hasMany('Robust\Projects\Models\Output', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outcomes()
    {
        return $this->hasMany('Robust\Projects\Models\Outcome', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('Robust\Projects\Models\Activity', 'project_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partners()
    {
        return $this->hasMany('Robust\Projects\Models\Partner', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function monitorings()
    {
        return $this->hasMany('Robust\Projects\Models\Monitoring', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indicators()
    {
        return $this->hasMany('Robust\Projects\Models\Indicator', 'project_id');
    }

    public function users()
    {
        return $this->belongsToMany('Robust\Admin\Models\User', 'project_users');
    }
}
