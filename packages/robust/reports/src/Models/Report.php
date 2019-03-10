<?php
namespace Robust\Reports\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 * @package Robust\Reports\Models
 */
class Report extends Model
{
    /**
     *
     */
    const DEFAULT_PAGE = 1;

    /**
     * @var mixed
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'reports_reports';

    /**
     * @var string
     */
    protected $namespace = 'Robust\Reports\Models\Report';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'template',
        'html'
    ];

    /**
     * @return mixed
     */
    public function fields()
    {
        return $this->hasMany('Robust\Reports\Models\ReportField');
    }
}
