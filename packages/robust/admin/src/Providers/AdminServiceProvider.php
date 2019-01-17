<?php

namespace Robust\Admin\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AdminServiceProvider
 * @package Robust\Report
 */
class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerIncludes();
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');
    }

    public function registerIncludes()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/permissions.php', 'admin.permissions');
        foreach (new \DirectoryIterator(__DIR__ . '/../../routes/admin/') as $fileInfo) {
            if (!$fileInfo->isDot()) {
                include __DIR__ . '/../../routes/admin/' . $fileInfo->getFilename();
            }
        }
        foreach (new \DirectoryIterator(__DIR__ . '/../../routes/website/') as $fileInfo) {
            if (!$fileInfo->isDot()) {
                include __DIR__ . '/../../routes/website/' . $fileInfo->getFilename();
            }
        }
    }
}
