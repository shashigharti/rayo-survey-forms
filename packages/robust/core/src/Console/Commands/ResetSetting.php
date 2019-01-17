<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Robust\Core\Helpers\CoreHelper;
use Robust\Core\Models\Setting;

class ResetSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:reset-setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It re-executes settings table seeder';

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
        $this->info("======= Resetting Settings Table ============");
        $this->info("=============================================");
        $packages = CoreHelper::names();

        $executeSeeds = $this->confirm("Would you like to execute settings table seeder? [y|N]", false);
        if ($executeSeeds) {
            foreach ($packages as $key => $package) {
                $this->info("Entering {$package}");
                $settings = config("{$key}.settings");
                if (is_array($settings))
                    foreach ($settings as $setting) {
                        $old_setting = Setting::where(['slug' => $setting['slug']])->first();

                        if (!$old_setting) {
                            $old_setting = Setting::create([
                                'display_name' => $setting['display_name'],
                                'slug' => $setting['slug'],
                                'values' => '{}',
                                'package_name' => $key
                            ]);
                        }
                        $old_setting->update([
                            'package_name' => $key,
                            'display_name' => $setting['display_name'],
                        ]);
                    }
            }
        }
    }
}
