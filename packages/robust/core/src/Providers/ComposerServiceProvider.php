<?php namespace Robust\Core\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['core::admin.layouts.default','core::website.layouts.users.default'], 'Robust\Core\Composers\ProfileComposer');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

}
