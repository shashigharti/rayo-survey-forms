<?php

namespace Robust\Core\Controllers\Admin;

use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Models\Setting;
use Robust\Core\Repositories\Admin\SettingRepository;
use Illuminate\Http\Request;

/**
 * Class SettingController
 * @package Robust\Core\Controllers
 */
class SettingsController extends Controller
{
    use ViewTrait;


    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->ui = 'Robust\Core\UI\Setting';
        $this->package_name = 'admin';
    }

    /**
     * @param $slug
     * @return $this
     */
    public function edit($slug = '')
    {
        $settings = Setting::when($slug, function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->first();

        $all_settings = Setting::all();
        return $this->display('core::admin.settings.index',
            [
                'settings' => ($settings) ? json_decode($settings->values, true) : [],
                'slug' => $slug,
                'all_settings' => $all_settings
            ]
        );
    }


    /**
     * @return string
     */
    public function store(Request $request, SettingRepository $setting)
    {
        $slug = $request->get('slug');
        $data = $request->except('_token', 'slug', 'files');
        $setting->store($slug, $data);
        return redirect()->route('admin.settings.edit', [$slug])->with('message',
            'You have sucessfully updated setting.');
    }
}
