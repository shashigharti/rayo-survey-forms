<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Robust\Core\Helpers\CoreHelper;

class ResetMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:reset-menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It re-executes menu table seeder';

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

        $executeSeeds = $this->confirm("Would you like to execute menu table  seeder? [y|N]", false);
        if ($executeSeeds) {
            DB::table('menus')->truncate();
            foreach ($packages as $key => $package) {
                $this->info("/packages/robust/{$key}/database/seeds/{$package}MenuTableSeeder.php");
                if (file_exists(base_path() . "/packages/robust/{$key}/database/seeds/{$package}MenuTableSeeder.php")) {
                    $this->info("Executing seed for $package");
                    $this->call("db:seed", ["--class" => "{$package}MenuTableSeeder"]);
                }
            }
        }
    }
}
