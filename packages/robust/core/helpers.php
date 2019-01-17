<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('is_active')) {
    /**
     * @param $url
     * @return string
     */
    function is_active($url)
    {
        return ($url === Request::url()) ? 'active' : '';
    }
}
if (!function_exists('is_edit_mode')) {
    /**
     * @param $model
     * @return bool
     */
    function is_edit_mode($model)
    {
        return ($model->exists) ? true : false;
    }
}


if (!function_exists('is_add_mode')) {
    /**
     * @param $model
     * @return bool
     */
    function is_add_mode($model)
    {
        return ($model->exists) ? false : true;
    }
}

if (!function_exists('settings')) {
    /**
     * @return string
     */
    function settings($type, $name = null)
    {
        $setting = (new \Robust\Core\Helpers\SettingsHelper)->get($type);
        if ($name && isset($setting[$name])) {
            return $setting[$name];
        } elseif ($name == null && $setting) {
            return $setting;
        } else {
            return '';
        }
    }
}

if (!function_exists('getMedia')) {
    /**
     * @return string
     */
    function getMedia($media_id)
    {
        if ($media_id) {
            $media = (new \Robust\Core\Models\Media)->find($media_id);
            return asset('/uploads/' . $media->id . '/' . $media->file);
        }

        return null;
    }
}

if (!function_exists('emails')) {
    /**
     * @return string
     */
    function emails($event)
    {
        if ($event) {
            $event_model = (new \Robust\Core\Models\EmailSetting())->where('event', $event)->first();
            if ($event_model) {
                $emails = explode(', ', $event_model->email);
                return $emails;
            }
            return null;
        }
        return null;
    }
}
