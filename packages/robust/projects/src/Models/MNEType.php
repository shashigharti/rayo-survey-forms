<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicator
 * @package Robust\Projects\Models
 */
class MNEType extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_mne_types';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\MNEType';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'description',
        'project_id'
    ];

}
