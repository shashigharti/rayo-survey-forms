@extends('core::admin.layouts.default')

@section('content')
    @set('settings_helper', new Robust\Core\Helpers\SettingsHelper)
    @set('setting', $settings_helper->getSettingBySlug($slug))
    @set('ui', new $ui)
    <div class="page">
        <div class="page--container">
            <div >
                @include('core::admin.settings.partials.tabs')
                <div class="panel">
                    <div class="panel--body">
                        <div class="form__wrapper system-settings">
                            @include("core::admin.partials.messages.info")
                            @if(isset($setting->package_name) && View::exists("{$setting->package_name}::admin.settings.{$slug}"))
                                @include("{$setting->package_name}::admin.settings.{$slug}")
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

