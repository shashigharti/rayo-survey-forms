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
    function settings($slug, $name = null)
    {
        if(!Schema::hasTable('settings')){
            return;
        }
        $setting = \Robust\Core\Models\Setting::where('slug', $slug)->first();
        if (isset($setting->values)) {
            $values = json_decode($setting->values, true);
        }

        if ($name == null) {
            return isset($values) ? $values : "";
        }

        return isset($values[$name]) ? $values[$name] : '';
    }
}

if (!function_exists('getMedia')) {
    /**
     * @return string
     */
    function getMedia($media_id)
    {
        $media = (new \Robust\Core\Models\Media)->find($media_id);
        if($media)
            return asset('/medias/' . $media->id . '/' . $media->file);

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
        }
        return null;
    }
}

if (!function_exists('get_date_string')) {
    /**
     * @return string
     */
    function get_date_string($param)
    {
        $sort = explode("-", $param);
        $sort_value =  explode("_", $sort[1]);
        return "{$sort_value[0]} {$sort_value[1]}";
    }
}

if (!function_exists('replace_seo_variables')) {

    /**
     * @param string $content
     * @param array $segments
     * @return string
     */
    function replace_seo_variables($content, $segments)
    {
        $replacements = [
            '*|PRICE_RANGE|*' => $segments[5] ?? '',
            '*|NAME|*' => isset($segments[3]) ? ucwords(str_replace('-', ' ', isset($segments[3]))) : ucwords(str_replace('-', ' ', isset($segments[1]))),
            '*|COMPANY_NAME|*' => settings('general-setting', 'company_name'),
        ];

        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        $content = replace_global_variables($content);

        return $content;
    }

}

if (!function_exists('seo')) {

    /**
     * @param $segments
     * @return array|null
     */
    function seo($segments)
    {
        $page = null;
        $segments_temp = $segments;

        for ($i = count($segments_temp) - 1; $i >= 0; $i--) {
            $partial_url_str = implode("/", $segments_temp);
            $page = (new \Robust\Core\Models\Page)->where('url', $partial_url_str)->first();
            if ($page) {
                break;
            }
            unset($segments_temp[$i]);
        }
        //home page not loading if nothing matches
        if(!$page){
            $page = (new \Robust\Core\Models\Page)->where('url', '/')->first();
        }

        if ($page) {
            $page->meta_description = replace_seo_variables($page->meta_description, $segments);
            $page->meta_title = replace_seo_variables($page->meta_title, $segments);
            $page->meta_keywords = replace_seo_variables($page->meta_keywords, $segments);
        }


        return ($page == null) ? null : $page;
    }
}


if (!function_exists('replace_global_variables')) {

    /**
     * @param string $content
     * @return string
     */
    function replace_global_variables($content)
    {
        $replacements = [
            '*|WEBSITE|*' => '<a href="' . \URL::to('/') . '">' . preg_replace('#^https?://#', '', \URL::to('/')) . '</a>',
            '*|SUBJECT_WEBSITE|*' => preg_replace('#^https?://#', '', \URL::to('/')),
            '*|FOOTER_TEXT|*' => '',
            '*|LOGO|*' => '<img style="max-width: 180px" src="" alt="">',
            '*|COMPANY_NAME|*' => settings('general-setting', 'company_name'),
            '*|CONTACT_EMAIL|*' => settings('general-setting', 'contact_email'),
            '*|PHONE_NUMBER|*' => settings('general-setting', 'phone_number'),
        ];

        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }
}

if (!function_exists('isAdmin')) {
    /**
     * @param $user
     * @return boolean
     */
    function isAdmin($user = null)
    {
        if ($user == null) {
            $user = \Auth::user();
        }
        return $user && (get_class($user->memberable) == 'Robust\Core\Models\Admin') ? true : false;
    }
}

if (!function_exists('getAvatar')) {
    /**
     * @param $user
     * @return boolean
     */
    function getAvatar($user = null)
    {
        if ($user == null) {
            $user = Auth::user();
        }
        $full_name = $user->memberable->first_name . " " . $user->memberable->last_name;
        return Avatar::create($full_name)->toBase64();
    }
}

if (!function_exists('replace_variables')) {
    /**
     * @param string $content
     * @param eloquent $member
     * @param array $data
     * @return string
     */
    function replace_variables($content, $member, $data)
    {
        $replacements = [
            '*|FIRSTNAME|*' => $member->first_name,
            '*|LASTNAME|*' => $member->last_name,
            '*|FULLNAME|*' => $member->first_name . " " . $member->last_name,
            '*|MAIL|*' => $member->email,
            '*|PHONE|*' => $member->phone_number,
            '*|VERIFICATION_LINK|*' => $data['verification_url'] ?? '',
            '*|UNSUBSCRIBE_LINK|*' => ''
        ];

        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        $content = replace_global_variables($content);
        return $content;
    }
}

if (!function_exists('email_template')) {
    /**
     * @param string $name
     * @return string
     */
    function email_template($name)
    {
        return \Robust\Core\Models\EmailTemplate::where('template', $name)->first();
    }
}


if (!function_exists('sort_array_by_array')) {

    /**
     * @param $arr_to_sort
     * @param $sort_by_arr
     * @return mixed
     */
    function sort_array_by_array($arr_to_sort, $sort_by_arr)
    {
        $arr_new = $arr_to_sort;
        if (count($sort_by_arr) > 0) {
            $arr_new = [];
            foreach ($arr_to_sort as $index => $elem) {
                if (in_array($elem, $sort_by_arr)) {
                    $id = array_search($elem, $sort_by_arr);
                    $arr_new[$id] = $elem;
                    unset($arr_to_sort[$index]);
                }
            }
        }
        ksort($arr_new);
        $arr_new = array_merge($arr_to_sort, $arr_new);
        ksort($arr_new);
        return $arr_new;
    }

}
