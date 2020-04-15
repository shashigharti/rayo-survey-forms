<?php


namespace Robust\Core\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Banner
 * @package Robust\Core\Models
 */
class Banner extends Model
{
    /**
     * @var string
     */
    protected $table = 'banners';
    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Banner';
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'properties',
        'template',
        'order',
        'status'
    ];

    /**
     * @param $value
     */
    public function setPropertiesAttribute($value)
    {
        $this->attributes['properties'] = json_encode($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('\Robust\Banners\Models\Image', 'banner_id', 'id');
    }

}
