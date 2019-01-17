<?php
namespace Robust\Core\Models;

class Backup extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'backups';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Backup';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'slug',
        'size',
        'created_at',
        'updated_at'
    ];

}
