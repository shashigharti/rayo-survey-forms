<?php
namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * @package Robust\Core\Models
 */
class Report extends Model
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'reports';

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Report';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'file_name',
        'package_name',
        'type',
        'user_id'
    ];
}
