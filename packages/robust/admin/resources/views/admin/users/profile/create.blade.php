@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @include("core::admin.partials.messages.info")
    <h4>@if(isset($title)){{ $title }}@endif</h4>
    @set('ui', new $ui)
    @set('form', new Robust\Core\Helpers\FormHelper)
    @inject('role_helper', 'Robust\Admin\Helpers\RoleHelper')
    {{ Form::model($model,['route' => $ui->getRoute($model, $slug), 'enctype' => 'multipart/form-data', 'method' => $ui->getMethod($model) ]) }}
    @include("admin::admin.partials.profile.{$slug}")
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn__small btn__purple']) }}
    </div>
    {{ Form::close() }}
@endsection