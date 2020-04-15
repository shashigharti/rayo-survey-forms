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
        'name', 
        'description', 
        'status', 
        'command', 
        'frequency', 
        'at', 
        'executed_at', 
        'next_execution_at', 
        'last_execution_status'
    ];

}
