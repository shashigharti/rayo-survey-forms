<?php
namespace Robust\Core\Extensions;


/**
 * Class BladeExtensions
 * @package Robust\Core\Extensions
 */
class BladeExtensions
{
    /**
     * @return void
     */
    public static function register()
    {

        \Blade::extend(function ($value, $compiler) {
            return preg_replace("/@set\('(.*?)'\,(.*)\)/", '<?php $$1 = $2; ?>', $value);
        });
    }
}
