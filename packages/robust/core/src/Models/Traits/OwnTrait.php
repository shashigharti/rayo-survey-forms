<?php

namespace Robust\Core\Models\Traits;

use Robust\Core\Models\Scopes\OwnScope;


/**
 * Class OwnTrait
 * @package Robust\Core\Models\Traits
 */
trait OwnTrait
{
    /**
     * Boot the scope.
     *
     * @return void
     */
    public static function bootOwnTrait()
    {
        static::addGlobalScope(new OwnScope);
    }
}
