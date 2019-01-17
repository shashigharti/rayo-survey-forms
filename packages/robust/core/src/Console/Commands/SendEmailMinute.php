<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class SendEmailMinute
 * @package Robust\Core\Console\Commands
 */
class SendEmailMinute extends Command
{

    /**
     * @var string
     */
    protected $signature = 'robust:send-email-minute';

    /**
     * @var string
     */
    protected $description = 'Update Schedule Daily';

    /**
     * SendEmailMinute constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function handle()
    {
        \Mail::send('core::admin.emails.mail-minute', ['minute' => 'One'], function ($m) {
            $m->from('jeewandhakal25@gmail.com', 'Jeewan Dhakal');
            $m->to('jeevandhakal31@gmail.com', 'Jeevan')->subject('TEST ONE MINUTE CRON EMAIL');
        });
    }
}
