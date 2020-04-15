<?php
namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dashboard
 * @package Robust\Core\Models
 */
class Dashboard extends Model
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'dashboards';

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Dashboard';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_default',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function widgets(){
        return $this->belongsToMany('Robust\Core\Models\Widget');
    }
}
