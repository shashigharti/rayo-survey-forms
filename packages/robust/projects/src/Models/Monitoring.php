<?php
namespace Robust\Projects\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Monitoring
 * @package Robust\Projects\Models
 */
class Monitoring extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_monitorings';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Monitoring';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'start_date',
        'type',
        'project_id',
        'end_date',
        'filter_type'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date'
    ];

    /**
     * @param $value
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);
    }


    /**
     * @param $value
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function indicators(){
        return $this->belongsToMany('Robust\Projects\Models\Indicator', 'project_indicator_monitoring');
    }
}
