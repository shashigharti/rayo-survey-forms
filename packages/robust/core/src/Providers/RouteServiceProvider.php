<?php

namespace Robust\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Robust\Core\Models\Redirect;

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

        if (Schema::hasTable('redirects')) {
            $redirect = \Robust\Core\Models\Redirect::where('from', \Request::url())->enabled()->first();
            if ($redirect) {
                $url = $redirect->to;
                $redirect->increment('hits');

                return redirect()->to($url, '301')->send();
            }
        }

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
            'middleware' => ['web', 'admin'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/admin/*') as $file) {
                require $file;
            }
        });

        Route::group([
            'middleware' => 'web',
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/website/*') as $file) {
                require $file;
            }
        });
        Route::group([
            'middleware' => ['web', 'api'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/api/*') as $file) {
                require $file;
            }
        });

        Route::group([
            'middleware' => ['web'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/core/routes/auth/*') as $file) {
                require $file;
            }
        });
    }
}
