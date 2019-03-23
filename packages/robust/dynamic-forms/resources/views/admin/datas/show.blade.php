@extends('core::admin.layouts.sub-layouts.blank')

@section('custom_design')

    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    @inject('setting_helper', Robust\Core\Helpers\SettingsHelper)
    @set('ui', new $ui)
    @set('setting', $setting_helper->get('general-setting'))

    @if(isset($ui->right_menu))
        <div class="col-sm-12 text-right pd-t-20">
            <span>
               @foreach($ui->right_menu as $key => $menu)
                    <div>
                        <div role="group" class="media-arrangement">
                            @can($menu['permission'])
                                <a class=" btn__purple" href="{{route($menu['url'], $data->id)}}">
                                    <span>{!!  $menu['display_name'] !!}</span>
                                </a>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </span>
        </div>
    @endif

    <div id="theme_preview">
        <div class="form__wrapper">

            <div class="project-info">
                <h6>Client name : {{ Auth::user()->first_name }}</h6>
                <h6>Form ID : {{ $model->id }}</h6>
            </div>

            <div class="text-right company-info">
                <h6>{{ (isset($setting['company_name'])) ? $setting['company_name'] : '' }}</h6>
                <h6>{{ (isset($setting['street_address'])) ? $setting['street_address'] : '' }}</h6>
                <h6>{{ (isset($setting['phone_number'])) ? 'Tel no : '. $setting['phone_number'] : '' }}</h6>
            </div>
            <div class="form__content clearfix">
                <div class="text-center col-md-12 clearfix form_title">
                    <h2 class="">{{ $model->title }}</h2>
                </div>
                <div class="form__field clearfix">
                    <div id = "form__view" data-base-url="{{env('APP_URL')}}" data-id="{{$data->id}}" data-slug="{{$model->slug}}" data-mode="edit" data-values="{{$data['values']}}">

                    </div>
{{--                    {!! Shortcode::compile("[dyn-form preview = false data_id = {$data->id}]{$model->title}[/dyn-form]")  !!}--}}
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection
