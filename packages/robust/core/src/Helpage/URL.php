<?php

namespace Robust\Core\Helpage;

use Illuminate\Support\Facades\Input;

class URL
{

    /**
     * Combines given parameters with the current GET parameters
     *
     * @param  array $params
     * @return string
     */
    public static function query(array $params = array())
    {
        $params = array_merge(Input::get(), $params);
        return http_build_query($params, '', '&');
    }
}
