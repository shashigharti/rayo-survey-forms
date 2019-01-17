<?php
namespace Robust\Core\Models;


/**
 * Class Setting
 * @package App
 */
class Setting extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = [
       'slug',
        'display_name',
        'values',
        'package_name'
    ];
}
