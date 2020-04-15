<?php

namespace Robust\Core\Repositories\Admin;

use Robust\Core\Models\Setting;

/**
 * Class SettingRepository
 * @package Robust\Core\Repositories
 */
class SettingRepository
{
    /**
     * @var Setting
     */
    private $settings;

    /**
     * SettingRepository constructor.
     * @param Setting $settings
     */
    public function __construct(Setting $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param $slug
     * @param $data
     */
    public function store($slug, $data)
    {
        $setting = $this->settings->where('slug', $slug)->first();
        if ($setting) {
            $setting->values = json_encode($data);

            $setting->save();
        } else {
            Setting::create([
                'slug' => $slug,
                'display_name' => $slug,
                'values' => json_encode($data)
            ]);
        }

    }

}