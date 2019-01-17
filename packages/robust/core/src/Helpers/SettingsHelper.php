<?php

namespace Robust\Core\Helpers;

use Robust\Core\Models\Setting;

/**
 * Class SettingsHelper
 * @package Robust\Core\Helpers
 */
class SettingsHelper
{
    /**
     * @return array
     */
    public function groups()
    {
        $settings = Setting::all();
        return $settings;
    }

    /**
     * @param $setting
     * @param $name
     * @return string
     */
    public function get($setting, $name = null)
    {
        $setting = Setting::where('slug', $setting)->first();
        if (isset($setting->values)) {
            $values = json_decode($setting->values, true);
        }

        if ($name == null) {
            return isset($values) ? $values : "";
        }

        return isset($values[$name]) ? $values[$name] : '';
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getSettingBySlug($slug)
    {
        return Setting::where('slug', $slug)->first();;
    }
}