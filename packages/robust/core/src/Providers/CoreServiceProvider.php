<?php

namespace Robust\Core\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Robust\Core\Events\Registration;
use Robust\Core\Extensions\BladeExtensions;
use Robust\Core\Helpers\CoreHelper;
use Webwizo\Shortcodes\Facades\Shortcode;

/**
 * Class CoreServiceProvider
 * @package Robust\Core
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        'Robust\Core\Console\Commands\MigrateAll',
        'Robust\Core\Console\Commands\ResetPermission',
        'Robust\Core\Console\Commands\ResetWidget',
        'Robust\Core\Console\Commands\ResetDashboard',
        'Robust\Core\Console\Commands\ResetMenu',
        'Robust\Core\Console\Commands\ResetReport',
        'Robust\Core\Console\Commands\Backup',
        'Robust\Core\Console\Commands\Restore',
        'Robust\Core\Console\Commands\SitemapGenerate',
        'Robust\Core\Console\Commands\ResetSetting'
    ];


    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function register()
    {
        $this->register_includes();
        $this->register_shortcodes();
    }


    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/frw.php' => config_path('core/frw.php'),
        ]);
        $this->register_shortcodes();
        $this->registerFacades();

        BladeExtensions::register();

        //include __DIR__ . '/../../macros.php';
    }

       public function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Asset', 'Robust\Core\Helpage\Assets');
        $loader->alias('Breadcrumb', 'Robust\Core\Helpage\Breadcrumb');
        $loader->alias('Meta', 'Robust\Core\Helpage\Meta');


    }

    public function register_includes()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/frw.php', 'core.frw');
        $this->mergeConfigFrom(__DIR__ . '/../../config/permissions.php', 'core.permissions');
        $this->mergeConfigFrom(__DIR__ . '/../../config/widgets.php', 'core.widgets');
        $this->mergeConfigFrom(__DIR__ . '/../../config/reports.php', 'core.reports');
        $this->mergeConfigFrom(__DIR__ . '/../../config/settings.php', 'core.settings');
        $this->mergeConfigFrom(__DIR__ . '/../../config/date-converter.php', 'core.date-converter');

        $packages = CoreHelper::names();
        foreach ($packages as $key => $package) {
            if (file_exists(base_path() . "/packages/robust/{$key}/helpers.php")) {
                include base_path() . "/packages/robust/{$key}/helpers.php";
            }
        }

        $this->commands($this->commands);
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'core');
        $this->loadViewsFrom(realpath(base_path('resources/views')), 'core');
    }


    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function register_shortcodes()
    {
        $packages = CoreHelper::names();
        foreach ($packages as $key => $package) {
            if (file_exists(base_path() . "/packages/robust/{$key}/config/shortcodes.php")) {
                $short_codes = (new Filesystem)->getRequire(base_path() . "/packages/robust/{$key}/config/shortcodes.php");
                foreach ($short_codes as $short_code => $callback) {
                    Shortcode::register($short_code, $callback);
                }
            }
        }
    }
}
