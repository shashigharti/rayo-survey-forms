<?php

namespace Robust\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Robust\Core\Models\Permission;
use Robust\Core\Models\Role;
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
        $this->info("============= Reset Permissions Table ================");
        $this->info("===============================================");
        $execute = $this->confirm("Would you like to execute permission table seeder? [y|N]", false);
        if ($execute) {
            // truncate permissions and role_permission table
            Permission::query()->truncate();
            DB::table('permissions')->truncate();
            DB::table('permission_role')->truncate();

            $all_permissions = (new PermissionHelper())->get_all_permissions();
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
        }
    }
}
