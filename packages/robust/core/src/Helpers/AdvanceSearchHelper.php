<?php


namespace Robust\Core\Helpers;


class AdvanceSearchHelper
{
    public function getSearchURL()
    {
        //for route with params
        $params = request()->route()->parameters();
        $route_name = request()->route()->getName();
        return $route_name === 'website.home' ? route('website.realestate.homes-for-sale') : route($route_name, $params);
    }
}
