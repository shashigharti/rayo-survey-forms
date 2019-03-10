@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    <div class="page">
        <div class="page-content">
            <div class="container form-container">
                @include("reports::admin.reports.partials.tabs")

                <div class="panel-box panel-default">
                    <div class="form__wrapper">
                        @include("core::admin.partials.messages.info")

                        {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
                        <div class="form-group form-material row">
                            <div class="col-sm-6">
                                {{ Form::label('title', 'Report Name', ['class' => 'control-label required' ]) }}
                                {{ Form::text('title', null, [
                                        'class'       => 'form-control name',
                                        'placeholder' => 'Report Name i.e. \'Project Progress\'',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::label('slug', 'Slug', ['class' => 'control-label required' ]) }}
                                {{ Form::text('slug', null, [
                                    'class'       => 'form-control slug',
                                    'placeholder' => 'slug i.e. \'slug\''
                                ]) }}
                            </div>
                        </div>
                        <div class="form-group form-material">
                            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
                        </div>
                        {{Form::close()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection