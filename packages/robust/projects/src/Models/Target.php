<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Target
 * @package Robust\Projects\Models
 */
class Target extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_targets';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Target';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'type',
        'project_id',
        'number_of_beneficiaries',
        'micro_beneficiaries'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function identificationFields()
    {
        return $this->hasMany('Robust\Projects\Models\IdentificationField');
    }

}
