<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_outcomes';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Outcome';

    /**
     * @var string
     */
    protected $fillable = [        
        'name',
        'assumption',
        'project_id',
        'parent_id',
        'numbering'
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
