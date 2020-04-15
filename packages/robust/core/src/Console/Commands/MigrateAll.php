<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Robust\Core\Helpers\CoreHelper;

/**
 * Class MigrateAll
 * @package Robust\Core\Console\Commands
 */
class MigrateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:migrate-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It executes all the migration  files';

    /**
     * Create a new command instance.
     *
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
        $this->info("== Migrating");
        $this->info("=============================================");
        $packages = CoreHelper::names();

        $executeMigrations = $this->confirm("Would you like to execute your migrations? [y|N]", false);
        if ($executeMigrations) {
            foreach ($packages as $key => $package) {
                $this->info("Executing migration for $package");
                $this->call("migrate", ["--path" => "packages/robust/$key/database/migrations"]);
            }
        }

        $packages = CoreHelper::names();
        $executeSeeds = $this->confirm("Would you like to execute your seeds? [y|N]", false);
        if ($executeSeeds) {
            foreach ($packages as $key => $package) {$executeSeeds = $this->confirm("Would you like to execute your seeds for {$package}? [y|N]", false);
                if ($executeSeeds) {
                    $this->info("/packages/robust/{$key}/database/seeds/{$package}DatabaseSeeder.php");
                    $this->info(file_exists(base_path() . "/packages/robust/{$key}/database/seeds/{$package}DatabaseSeeder.php"));
                    if (file_exists(base_path() . "/packages/robust/{$key}/database/seeds/{$package}DatabaseSeeder.php")) {
                        $this->info("Executing seed for $package");
                        $this->call("db:seed", ["--class" => "{$package}DatabaseSeeder"]);
                    }
                }
            }
        }
    }
}
