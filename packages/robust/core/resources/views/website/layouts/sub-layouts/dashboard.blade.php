@extends('core::admin.layouts.default')
@section('content')
    @set('ui', new $ui)
    <div class="page">
        <div class="page-content container-fluid">
            @include("dynamic-forms::user.form.view")
        </div>
    </div>
@endsection
