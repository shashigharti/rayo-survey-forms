<?php
namespace Robust\Core\Helpers;

class ImageHelper
{
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