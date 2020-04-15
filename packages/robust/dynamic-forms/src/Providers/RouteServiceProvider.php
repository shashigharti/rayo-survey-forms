<?php
namespace Robust\DynamicForms\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
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
            'middleware' => ['web', 'admin'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/dynamic-forms/routes/admin/*') as $file) {
                if (!is_dir($file)) {
                    require $file;
                }
            }
        });
        Route::group([
            'middleware' => ['web'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/dynamic-forms/routes/admin/ajax/*') as $file) {
                require $file;
            }
        });
        Route::group([
            'middleware' => ['web'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/dynamic-forms/routes/admin/user/*') as $file) {
                require $file;
            }
        });
        Route::group([
            'middleware' => 'web',
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/dynamic-forms/routes/website/*') as $file) {
                require $file;
            }
        });
        Route::group([
            'middleware' => ['web', 'api'],
        ], function ($router) {
            foreach (glob(base_path() . '/packages/robust/dynamic-forms/routes/api/*') as $file) {
                require $file;
            }
        });

    }
}
