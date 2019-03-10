@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    @inject('user_helper', 'Robust\Admin\Helpers\UserHelper')
    <div class="page {{ $title }}">
        <div class="page-content">
            <div class="container">
                <div class="page-title">
                    <div class="rayo-breadcrumb pull-left">
                        <span><h3>{{ $title }}</h3></span>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Workflow</a></li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </div>

                </div>

                @include("core::admin.partials.tabs.tabs")
                <div class="panel form-panel">

                    @include("core::admin.partials.messages.info")
                    <div class="panel-body panel-box default-form">
                        {!! Form::open(['route' => ['admin.projects.permissions.store'], 'method' => 'POST']) !!}

                        <fieldset>
                            <div class="form-group form-material clearfix">
                                <div class="form-group col-md-5">
                                    {{ Form::label('users_list', 'Users', ['class' => 'control-label' ]) }}
                                    {{ Form::select('users_list', $ui->getUsersForDropdown($model),null ,[
                                    'class' => 'drag__drop-multiselect',
                                    'id' => 'select_source',
                                    'multiple' => 'multiple'
                                    ]) }}
                                </div>
                                <div class="col-md-2 text-center drag__drop-buttons">
                                    <span><a href="javascript:void(0)" id="add_to_destination" class="btn theme-btn">
                                            &gt;&gt;</a></span>
                                    <span><a href="#" id="remove_from_destination" class="btn theme-btn">
                                            &lt;&lt;</a></span>

                                </div>
                                <div class="form-group col-md-5">
                                    {{ Form::label('users', 'Selected', ['class' => 'control-label' ]) }}
                                    {{ Form::select('users[]',  $ui->getSelectedUsers($model)->toArray(), $ui->getSelectedUsersId($model)->toArray() ,[
                                    'class' => 'drag__drop-multiselect',
                                    'id' => 'select_destination',
                                    'multiple' => 'multiple'
                                    ]) }}
                                </div>
                            </div>
                            {{ Form::hidden('project_id', $model->id) }}
                            <div class="form-group form-material">
                                {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include("core::admin.partials.modals.modal")
    @include("core::admin.partials.modals.crud")
@endsection
