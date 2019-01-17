<?php

namespace Robust\Core\Models;

class Redirect extends BaseModel
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'redirects';

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Redirect';

    /**
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'status',
        'hits',
    ];

}
