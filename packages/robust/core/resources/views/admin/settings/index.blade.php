@extends('core::admin.layouts.sub-layouts.create-without-tabs')

@section('form')
    @set('settings_helper', new Robust\Core\Helpers\SettingsHelper)
    @set('setting', $settings_helper->getSettingBySlug($slug))
    @set('ui', new $ui)
   <div class="row">
       <div class="container">
          <div class="row">
              <div class="col s12">
                  @include('core::admin.settings.partials.tabs')
              </div>
              <div class="col s12">
                 <div class="panel card tab--content">
                    @include("core::admin.partials.messages.info")

                    @if(View::exists("{$setting->package_name}::admin.settings.{$slug}"))
                        @include("{$setting->package_name}::admin.settings.{$slug}")
                    @endif
                 </div>
              </div>
          </div>
       </div>
    </div>
@endsection

