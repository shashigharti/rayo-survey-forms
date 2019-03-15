<?php
namespace Robust\Core\Models;


/**
 * Class Setting
 * @package App
 */
class UserSetting extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'user_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'display_name',
        'values',
        'package_name'
    ];
}
