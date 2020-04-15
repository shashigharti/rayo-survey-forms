<?php
namespace Robust\Admin\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class Profile
 * @package Robust\Admin\UI
 */
class Profile extends BaseUI
{
    /**
     * @return string
     */
    public function getMethod($model)
    {
        return 'PUT';
    }


    /**
     * @param $profile
     * @return array
     */
    public function getRoute($profile, $slug = null)
    {
        return ['admin.profile.settings.update', $profile->id, $slug];
    }

    /**
     * @return array
     */
    public function getSubmitText()
    {
        return 'Save';
    }

    public function getTabs($model)
    {

        return [
            'General' => ['url' => route('admin.profile.settings.edit', [\Auth::user()->id, 'general']), 'permission' => 'pages.manage'],
            'Password' => ['url' => route('admin.profile.settings.edit', [\Auth::user()->id, 'password']), 'permission' => 'pages.downloads.manage'],
        ];
    }

}
