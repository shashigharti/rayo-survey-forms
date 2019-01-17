<?php
namespace Robust\Core\Models;


/**
 * Class Media
 * @package Robust\Core\Models
 */
class Media extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'medias';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'file',
        'type',
        'extension'
    ];

}
