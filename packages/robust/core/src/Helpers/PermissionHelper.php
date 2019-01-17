<?php

namespace Robust\Core\Helpers;

use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\DB;
use Robust\Admin\Models\Permission;
use Robust\Admin\Models\Role;

/**
 * Class PermissionHelper
 * @package Robust\Core\Helpers
 */
class PermissionHelper
{

  /**
   * @return array
   */
  public function get_all_permissions()
  {
      $all_permissions = [];
//      if(\Schema::hasTable('permissions')){
//          $permissions = Permission::all() ;
//          foreach ($permissions as $permission) {
//              $all_permissions[$permission->package_name][$permission->name] = $permission->display_name;
//          }
//
//      }else{
//          foreach (CoreHelper::names() as $key => $value) {
//              $all_permissions[$value] = config("{$key}.permissions.actions");
//          }
//      }
      foreach (CoreHelper::names() as $key => $value) {
          $all_permissions[$value] = config("{$key}.permissions.actions");
      }
      return $all_permissions;

  }

  public function get_all_permissions_db()
  {
      return $this->get_all_permissions();
  }

  public function hasPermission($role, $permission_name)
  {
      if (!isset($role->id)) {
            return false;
      }
      $permissions = Role::find($role->id)->permissions->pluck('id', 'name');
      $permissions = isset($permissions) ? $permissions->toArray() : [];

      return isset($permissions[$permission_name]) ? true : false;
  }

}
