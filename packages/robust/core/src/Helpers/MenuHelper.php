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
        $menus = Menu::where('parent_id', 0)->orderBy('order', 'ASC')->get();
        return $menus;
    }

    /**
     * @return mixed
     */
    public function getSubMenus($id)
    {
        $menus = Menu::where('parent_id', $id)->orderBy('order', 'ASC')->get();
        return $menus;
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
     * @param $package_name
     * @return mixed
     */
    public function getPrimaryMenu($package_name)
    {
        return Menu::where('parent_id', 0)
            ->where('package_name', $package_name)->first();
    }

}
