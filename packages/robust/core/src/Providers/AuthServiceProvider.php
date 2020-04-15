<?php
namespace Robust\Core\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Robust\Core\Helpers\PermissionHelper;
use Robust\Core\Helpers\PermissionHelper as CheckPermission;

/**
 * Class AuthServiceProvider
 * @package Robust\Core\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * @param Gate $gate
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies($gate);

        $package_permissions = (new PermissionHelper)->get_all_permissions_db();
        foreach ($package_permissions as $package => $permissions) {
            if ($permissions == null) {
                continue;
            }
            foreach ($permissions as $name => $permission) {
                $gate->define($name, function ($user)  use ($name){
                    return (new CheckPermission)->check_permission($user, $name);
                });
            }
        }
    }
}
