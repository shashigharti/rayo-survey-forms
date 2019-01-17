<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Robust\Admin\Models\Permission;
use Robust\Admin\Models\Role;
use Robust\Core\Helpers\PermissionHelper;

class ResetPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robust:reset-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It resets the permissions';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("\n=============================================");
        $this->info("============ Reset Permission for Admin ===========");
        $this->info("=============================================");
        $executePermissions = $this->confirm("Would you like to reset permissions ? [y|N]", false);
        if ($executePermissions) {
            // truncate roles permission table
            $all_permissions = (new PermissionHelper())->get_all_permissions();
//            DB::table('permissions')->truncate();
            $role = Role::find(1);

            foreach ($all_permissions as $package_name => $permissions) {
                if (is_null($permissions)) {
                    continue;
                }

                foreach ($permissions as $action => $display_name) {
                    $permission = Permission::where('name', $action)->first();
                    if (!$permission) {
                        $permission = Permission::firstOrCreate([
                            "name" => $action,
                            "display_name" => $display_name,
                            "package_name" => $package_name
                        ]);
                    }
                    $datas = \DB::table('permission_role')->where('permission_id', $permission->id)->where('role_id', $role->id)->first();
                    if (!$datas) {
                        $role->permissions()->attach($permission->id);

                    }
                }
            }

//            DB::table('permission_role')->truncate();

//            $all_permissions = Permission::all();
//
//            foreach ($all_permissions as $permission) {
//                $role->permissions()->attach($permission->id);
//            }
        }
    }
}
