<?php

namespace Robust\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

/**
 * Class RouteServiceProvider
 * @package Robust\Core\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('settings')) {
            if (settings('maintenance-mode', 'maintenance_mode') == 1 && settings('maintenance-mode', 'maintenance_type') == 'completely_down' && !\App::isDownForMaintenance()) {
                Artisan::call('down');
            } elseif (\App::isDownForMaintenance() && settings('maintenance-mode', 'maintenance_mode') == 0) {
                Artisan::call('up');
            }
        }
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => ['web', 'auth', 'admin'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/admin/*') as $file) {
                if (!is_dir($file)) {
                    require $file;
                }
            }
        });

        Route::group([
            'middleware' => ['web', 'auth'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/website/user/*') as $file) {
                if (!is_dir($file)) {
                    require $file;
                }
            }
        });

        Route::group([
            'middleware' => 'web',
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/website/*') as $file) {
                if (!is_dir($file)) {
                    require $file;
                }
            }
        });
        Route::group([
            'middleware' => ['web', 'api'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/api/*') as $file) {
                if (!is_dir($file)) {
                    require $file;
                }
            }
        });


    }
}
