@extends('core::admin.layouts.sub-layouts.blank')

@section('custom_design')

    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    @inject('setting_helper', Robust\Core\Helpers\SettingsHelper)
    @set('ui', new $ui)
    @set('setting', $setting_helper->get('general-setting'))

    @if(isset($ui->right_menu))
        <span class="create-btn clearfix pull-right">
           @foreach($ui->right_menu as $key => $menu)
                <div class="pull-right">
                    <div role="group" class="media-arrangement">
                        @can($menu['permission'])
                            <a href="{{route($menu['url'], $data->id)}}">
                                <span>{!!  $menu['display_name'] !!}</span>
                            </a>
                        @endcan
                    </div>
                </div>
            @endforeach

        </span>
    @endif

    <div id="theme_preview">
        <div class="col-md-12 panel-body dynamic__form-container form__wrapper default-form">

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
                    <table class="table">
                        @foreach($form_data['data'] as $key=>$data)
                            @if(is_array($data))
                                @foreach($data as $key=>$d)
                                    <th class="text-uppercase font-weight-bold">{{$key}}</th>
                                @endforeach
                            @else
                                <th class="text-uppercase font-weight-bold">{{$key}}</th>
                            @endif

                        @endforeach
                            <tr>
                            @foreach($form_data['data'] as $key=>$data)
                                @if(is_array($data))
                                    @foreach($data as $d)
                                        <td>{{$d}}</td>
                                    @endforeach
                                @else
                                    {{--Use base64 img if signature is being displayed--}}
                                    @if($key == "signature")
                                            <td><img width="200px" height="40px" src="{{$data}}" alt="signature"></td>
                                    @else
                                            <td>{{$data}}</td>
                                    @endif

                                @endif
                            @endforeach
                        </tr>
                    </table>
                  <ul>

                  </ul>
{{--                    {!! Shortcode::compile("[dyn-form preview = false data_id = {$data->id}]{$model->title}[/dyn-form]")  !!}--}}
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection
