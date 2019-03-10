<?php
namespace Robust\Projects\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ProjectsServiceProvider
 * @package Robust\Projects\Providers
 */
class ProjectsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->register_includes();
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'projects');

    }

    public function register_includes()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/permissions.php', 'projects.permissions');
        $this->mergeConfigFrom(__DIR__ . '/../../config/widgets.php', 'projects.widgets');
    }

}
