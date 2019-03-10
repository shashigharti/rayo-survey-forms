<?php
namespace Robust\Reports\Providers;

use Illuminate\Support\ServiceProvider;
use Robust\Core\Events\Registration;


class ReportsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->register_includes();
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'reports');
    }

    public function register_includes()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/permissions.php', 'reports.permissions');
        foreach (new \DirectoryIterator(__DIR__ . '/../../routes/') as $fileInfo) {
            if (!$fileInfo->isDot()) {
                include __DIR__ . '/../../routes/' . $fileInfo->getFilename();
            }
        }
    }


}
