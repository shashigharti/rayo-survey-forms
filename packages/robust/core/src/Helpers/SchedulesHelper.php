<?php

namespace Robust\Core\Helpers;

use Robust\Core\Models\Command;

/**
 * Class SchedulesHelper
 * @package Robust\Core\Helpers
 */
class SchedulesHelper
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCommands()
    {
        $commands = Command::all();
        return $commands->pluck('name', 'id');
    }
}