<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;

class SendEmailWeekly extends Command
{

    protected $signature = 'robust:send-email-weekly';

    protected $description = 'Update Schedule Weekly';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        \Mail::send('core::admin.emails.mail-weekly', ['weekly' => '15'], function ($m) {
            $m->from('jeewandhakal25@gmail.com', 'Jeewan Dhakal');
            $m->to('jeevandhakal31@gmail.com', 'Jeevan')->subject('TEST WEEKLY CRON EMAIL');
        });
    }
}
