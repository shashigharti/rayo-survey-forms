<?php

namespace Robust\Core\Helpers;


use Robust\Core\Models\Permission;
use Robust\Core\Models\Role;
use Robust\Core\Models\User;

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

    public function check_permission($user, $action)
    {
        $user = User::find($user->id);
        $roles = $user->roles;
        $permissions = [];
        foreach ($roles as $role) {
            $permissions = $permissions + array_column($role->permissions->toArray(), 'name');
        }
        return in_array($action, $permissions);
    }

}
