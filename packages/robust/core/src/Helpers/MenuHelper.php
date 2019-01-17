<?php
namespace Robust\Core\Helpers;

use Robust\Core\Models\Menu;

/**
 * Class MenuHelper
 * @package Robust\Core\Helpers
 */
class MenuHelper
{
    /**
     * @return array
     */
    public function getMenus()
    {
        $menus = Menu::where('parent_id', 0)->orderBy('display_name', 'ASC')->get();
        return $menus;
    }

    /**
     * @return mixed
     */
    public function getSubMenus($id)
    {
        $menus = \DB::table('menus')->where('parent_id', $id)->orderBy('display_name', 'ASC')->get();
        return $menus;
    }

    /**
     * @param $package_name
     * @return mixed
     */
    public function getPrimaryMenu($package_name)
    {
        return Menu::where('parent_id', 0)
            ->where('package_name', $package_name)->first();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getMenu($name)
    {
        return Menu::where('name', $name)->first();
    }

    /**
     * Return all the parent menus with children menus
     * @return mixed
     */
    public function getAllMenus()
    {
        //children.children is used to retrieve children of childrens
        $menus = Menu::where('parent_id', 0)->with('children', 'children.children')->get();
        return isset($menus) ? $menus->toArray() : [];
    }

    /**
     * Return all the parent menus with children menus
     * @return mixed
     */
    public function getAllMenusByPackage($package_name)
    {
        //children.children is used to retrieve children of childrens
        $menus = Menu::where('parent_id', 0)->where('package_name', '=', $package_name)->with('children', 'children.children')->get();
        return isset($menus) ? $menus : [];
    }


}