<?php

namespace Robust\Core\Helpage\Traits;

trait SingletonTrait
{

    /**
     * @var Object
     */
    protected static $singleton = null;

    /**
     * Fetch the instance of a class
     *
     * @return Object
     */
    public static function getInstance()
    {
        if (!self::$singleton) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}
