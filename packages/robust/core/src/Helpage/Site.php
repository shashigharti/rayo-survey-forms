<?php

namespace Robust\Core\Helpage;

/**
 * Class Site
 * @package Robust\Core\Helpage
 */
/**
 * Class Site
 * @package Robust\Core\Helpage
 */
class Site
{
    /**
     * @param $view
     * @return mixed
     */
    public static function templateResolver($view)
    {
        $overriden = str_replace('::', '.', 'packages.robust.' . $view);
        if (view()->exists($overriden)) {
            $view = $overriden;
        }
        return $view;
    }

    /**
     * @return mixed
     */
    public static function getClientIP()
    {
        $request = \Request::instance();
        $request->setTrustedProxies(['127.0.0.1']);
        return $request->getClientIp();
    }

    /**
     * @param $asset
     * @param $type
     * @param bool $secure
     * @param array $attributes
     * @return mixed
     */
    public static function assets($asset, $type, $secure = false, $attributes = [])
    {
        $new_url = sprintf($asset);
        $new_url = $new_url . "?v=" . filemtime(public_path($new_url));
        return \Html::$type($new_url, $attributes, $secure);
    }
}
