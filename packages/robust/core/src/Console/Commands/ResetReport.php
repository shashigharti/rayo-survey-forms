<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Robust\Core\Helpers\CoreHelper;
use Robust\Core\Models\Report;

class ResetReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:reset-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It resets available reprots';

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
    public function handle(Filesystem $filesystem, Report $report)
    {
        $packages = CoreHelper::names();
        DB::table('reports')->truncate();

        foreach ($packages as $key => $package) {
            $this->info("Entering {$package}");

            $package_reports = config("{$key}.reports");

            if (is_array($package_reports)) {
                foreach ($package_reports as $package_report) {
                    if ($filesystem->exists(base_path() . "/packages/robust/{$key}/resources/views/admin/reports/{$package_report['file_name']}.blade.php")) {
                        $report_data = [
                            'name' => $package_report['display_name'],
                            'slug' => str_slug($package_report['display_name']),
                            'description' => $package_report['description'],
                            'package_name' => $key,
                            'file_name' => $package_report['file_name'],
                            'permission' => $package_report['permission']
                        ];
                        $report->create($report_data);
                    }

                }
            }
            if (is_array(config("reports.{$key}"))) {
                $custom_reports = config("reports.{$key}");
                foreach ($custom_reports as $custom_report) {
                    print_r($filesystem->exists(resource_path() . "/views/packages/robust/{$key}/admin/reports/{$custom_report['file_name']}.blade.php"));

                    if ($filesystem->exists(resource_path() . "/views/packages/robust/{$key}/admin/reports/{$custom_report['file_name']}.blade.php")) {
                        $report_data = [
                            'name' => $custom_report['display_name'],
                            'slug' => str_slug($custom_report['display_name']),
                            'description' => $custom_report['description'],
                            'package_name' => $key,
                            'file_name' => $custom_report['file_name'],
                            'permission' => $custom_report['permission']
                        ];
                        $report->create($report_data);
                    }

                }
            }

        }
    }
}
