<?php

namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class BaseModel
 * @package Robust\Core\Models
 */
class BaseModel extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDisabled($query)
    {
        return $query->where('status', self::STATUS_DISABLED);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('status', self::STATUS_ENABLED);
    }


    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            foreach ($model->attributes as $key => $value) {
                $model->{$key} = ((is_string($value) || is_int($value)) && $value == -1) ? null : $value;
            }
        });
    }
}
