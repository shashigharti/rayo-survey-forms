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
        View::composer([
            'core::admin.layouts.default'
        ], 'Robust\Core\Composers\ProfileComposer');
        View::composer([
            '*::website.*',
            '*::website.home'
        ], 'Robust\Core\Composers\FrontendComposer');

        View::composer([
            '*::admin.*'
        ], 'Robust\Core\Composers\AdminComposer');

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
