<?php
namespace Robust\Core\Providers;

use Illuminate\Mail\MailServiceProvider;
use Robust\Core\Services\RobustTransportManager;

/**
 * Class RobustMailServiceProvider
 * @package Robust\Core\Providers
 */
class RobustMailServiceProvider extends MailServiceProvider{

    protected function registerSwiftTransport(){
        $this->app['swift.transport'] = $this->app->share(function($app)
        {
            return new RobustTransportManager($app);
        });
    }
}