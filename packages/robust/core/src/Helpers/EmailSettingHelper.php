<?php

namespace Robust\Core\Helpers;


use Robust\Core\Models\EmailSetting;

/**
 * Class EmailSettingHelper
 * @package Robust\Core\Helpers
 */
class EmailSettingHelper
{
    /**
     * @return array
     */
    public function getEventList()
    {
        $email_settings = [];

        foreach (CoreHelper::names() as $key => $value) {
            $each_setting = config("{$key}.email-settings");
            if ($each_setting) {
                foreach ($each_setting as $setting) {
                    $email_settings[$setting['setting_name']] = $setting['display_name'];
                }
            }

        }
        return $email_settings;
    }
}
