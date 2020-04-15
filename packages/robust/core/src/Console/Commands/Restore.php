<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class Restore
 * @package Robust\Core\Console\Commands
 */
class Restore extends Command
{

    protected $signature = 'robust:restore {user}  {password} {schema} {file}';


    protected $description = 'Restores the backup utility';


    /**
     * Restore constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info("\n=============================================");
        $this->info("========== Restoring Database ============");
        $this->info("===============================================");
        $execute = $this->confirm("Would you like to run restore command? [y|N]", false);  

        if ($execute) {
            $user = $this->argument('user');
            $schema = $this->argument('schema');
            $password = $this->argument('password');
            $file = $this->argument('file');

            $command = sprintf('mysql -u %s  -p%s \'%s\' < %s',$user, $password,$schema, $file);
            exec($command);
        }
    }
}