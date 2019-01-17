<?php
namespace Robust\Core\Helpers;

/**
 * Class CoreHelper
 * @package Robust\Core\Helpers
 */
class CoreHelper
{

    /**
     * @return array
     */
    public static function service_providers()
    {
        $packages = [];

        foreach (self::names() as $key => $value) {
            $packages[] = sprintf('Robust\%s\Providers\%sServiceProvider', $value, $value);
            if(file_exists(base_path() . "/packages/robust/" . strtolower($key) ."/src/Providers/RouteServiceProvider.php")){
                $packages[] = sprintf('Robust\%s\Providers\RouteServiceProvider', $value, $value);
            }
            if(file_exists(base_path() . "/packages/robust/" . strtolower($key) ."/src/Providers/AuthServiceProvider.php")){
                $packages[] = sprintf('Robust\%s\Providers\AuthServiceProvider', $value, $value);
            }
            if(file_exists(base_path() . "/packages/robust/" . strtolower($key) ."/src/Providers/EventServiceProvider.php")){
                $packages[] = sprintf('Robust\%s\Providers\EventServiceProvider', $value, $value);
            }
            if(file_exists(base_path() . "/packages/robust/" . strtolower($key) ."/src/Providers/ComposerServiceProvider.php")){
                $packages[] = sprintf('Robust\%s\Providers\ComposerServiceProvider', $value, $value);
            }
        }
        return $packages;
    }

    /**
     * @return array
     */
    public static function names()
    {
        foreach (glob(base_path() . '/packages/robust/*') as $directory) {
            $name = basename($directory);
            $names[$name] = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        }
        unset($names['core']);
        $names = ["core" => "Core"] + $names;
        return $names;
    }
}