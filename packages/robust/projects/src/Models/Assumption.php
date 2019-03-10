<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicator
 * @package Robust\Projects\Models
 */
class Assumption extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_assumptions';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Assumption';

    /**
     * @var string
     */
    protected $fillable = [

        'project_id',
        'assumption',
        'assumable_id',
        'assumable_type',
        'numbering',
        'parent_id'
    ];

    /**
     * Get all of the owning indicatable models.
     */
    public function assumable()
    {
        return $this->morphTo();
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return ['text' => 'Textbox',
            'address' => 'Address',
            'checkbox' => 'Multiple Choice',
            'option' => 'Radio',
            'date' => 'Date',
            'textarea' => 'Open Ended Question',
            'numeric' => 'Numeric'
        ];
    }

    public function getNumberNameAttribute()
    {
        return $this->numbering . ".    " . $this->name;
    }

}
