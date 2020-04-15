<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDashboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:reset-dashboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It resets the permissions';

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
        $this->info("============ Reset Dashboard for User ===========");
        $this->info("=============================================");
        $execute = $this->confirm("Would you like to reset permissions ? [y|N]", false);

        if ($execute) {
            DB::table('dashboards')->truncate();
            DB::table('dashboard_widget')->truncate();

            $users = \Robust\Core\Models\User::all();
            foreach($users as $user){
                \Robust\Core\Models\Dashboard::create([
                    'name' => "{$user->first_name} Dashboard",
                    'slug' => str_slug("{$user->first_name} Dashboard"),
                    'description' => 'Main Dashboard',
                    'is_default' => true,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
