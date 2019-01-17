<?php
namespace Robust\Core\Models;


class Command extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'commands';


    /**
     * @var string
     */
    protected $fillable = [
        'name'
    ];

}
