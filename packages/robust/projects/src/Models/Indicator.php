<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicator
 * @package Robust\Projects\Models
 */
class Indicator extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_indicators';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Indicator';

    /**
     * @var string
     */
    protected $fillable = [
        'parent_id',
        'project_id',
        'output_id',
        'name',
        'type',
        'baseline',
        'indicatable_id',
        'indicatable_type',
        'numbering',
        'registration',
        'target_id',
        'properties',
        'indicatable_type_name'

    ];

    /**
     * Get all of the owning indicatable models.
     */
    public function indicatable()
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
            'select' => 'Dropdown',
            'checkbox' => 'Multiple Choice',
            'radio' => 'Radio',
            'date' => 'Date',
            'textarea' => 'Open Ended Question',
            'number' => 'Numeric'
        ];
    }

    public function getNumberNameAttribute()
    {
        return $this->numbering . ".    " . $this->name;
    }

}
