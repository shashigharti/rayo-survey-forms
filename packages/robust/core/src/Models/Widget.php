<?php
namespace Robust\Core\Models;

class Widget extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'widgets';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'package_name',
        'path',
        'permission'
    ];
}
