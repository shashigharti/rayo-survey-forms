<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Robust\Core\Helpers\CoreHelper;
use Robust\Core\Models\Widget;

class ResetWidget extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:reset-widget';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It resets available widgets';

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
    public function handle(Filesystem $filesystem, Widget $widget)
    {
        $this->info("\n=============================================");
        $this->info("========== Resetting Widgets Table ============");
        $this->info("===============================================");
        $execute = $this->confirm("Would you like to reset widgets table seeder? [y|N]", false);        
        
        if ($execute) {
            $packages = CoreHelper::names();
            DB::table('widgets')->truncate();
            
            foreach ($packages as $key => $package) {
                $this->info("Entering {$package}");

                $package_widgets = config("{$key}.widgets");
                
                if (is_array($package_widgets)) {
                    foreach ($package_widgets as $package_widget) {
                        if ($filesystem->exists(base_path() . "/packages/robust/{$key}/resources/views/admin/dashboard-widgets/{$package_widget['file_name']}.blade.php")) {
                            $widget_data = [
                                'name' => $package_widget['display_name'],
                                'path' => $package_widget['file_name'],
                                'package_name' => $key,
                                'permission' => $package_widget['permission']
                            ];
                            $widget->create($widget_data);
                        }

                    }
                }

            }
        }
    }
}
