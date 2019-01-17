<?php

namespace Robust\Core\Models;


/**
 * Class Schedule
 * @package Robust\Core\Models
 */
class Schedule extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'schedules';

    /**
     * @var array
     */
    protected $fillable = [
        'command',
        'interval',
        'email_report'
    ];

    /**
     * @return string
     */
    public function getUI()
    {
        return 'Robust\Core\UI\Schedule';
    }

}
