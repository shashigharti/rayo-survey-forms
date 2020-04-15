@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @include("core::admin.partials.messages.info")
    <h4>@if(isset($title)){{ $title }}@endif</h4>
    @set('ui', new $ui)
    @inject('role_helper', 'Robust\Core\Helpers\RoleHelper')
    {{ Form::model($model,['route' => $ui->getRoute($model, $slug), 'enctype' => 'multipart/form-data', 'method' => $ui->getMethod($model) ]) }}
    @include("admin::admin.partials.profile.{$slug}")
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{ Form::close() }}
@endsection
