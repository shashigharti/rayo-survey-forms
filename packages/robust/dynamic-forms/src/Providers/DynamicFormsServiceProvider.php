<?php
namespace Robust\DynamicForms\Providers;

use Illuminate\Support\ServiceProvider;
use Webwizo\Shortcodes\Facades\Shortcode;

/**
 * Class DynamicFormServiceProvider
 * @package Robust\DynamicForm\Providers
 */
class DynamicFormsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->register_includes();
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'dynamic-forms');
    }

   
    public function register_includes()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/permissions.php', 'dynamic-forms.permissions');
        $this->mergeConfigFrom(__DIR__ . '/../../config/widgets.php', 'dynamic-forms.widgets');
        $this->mergeConfigFrom(__DIR__ . '/../../config/reports.php', 'dynamic-forms.reports');
    }

}
