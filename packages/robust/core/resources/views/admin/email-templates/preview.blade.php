@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    <div class="row">
        {!! html_entity_decode($model->body) !!}
    </div>
@endsection