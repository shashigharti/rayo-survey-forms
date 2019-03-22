@extends('core::admin.layouts.default')
@section('content')
    @inject('permission_helper', '\Robust\Core\Helpers\PermissionHelper')
    @set('ui', new $ui)
    <div class="page">
        <div class="page--container">
            <div class="panel">
                <div class="panel--body">
                    <div class="form__wrapper">
                        @include("core::admin.partials.messages.info")
                        {{ Form::model($model, ['route' => ['admin.roles.update', $model->id], 'method' => $ui->getMethod($model) ]) }}
                        <div class="form-group form-material row">
                            <div class="">
                                <div class="col-sm-6">
                                    {{ Form::label('name', 'Name', ['class' => 'control-label' ]) }}
                                    {{ Form::text('name', null, [
                                            'class'       => 'form-control',
                                            'placeholder' => 'Name i.e. \'Admin\'',
                                            'required'    => 'required'
                                        ]) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-material row">
                            <div class="col-sm-12">
                                {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                                {{ Form::textarea('description', null, [
                                       'class'       => 'form-control',
                                       'placeholder' => 'Role Description'
                                   ]) }}
                            </div>
                        </div>
                        <div class="form-group form-material row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" class="select_all"></th>
                                        <th>Group</th>
                                        <th>Permissions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permission_helper->get_all_permissions_db() as $group => $permissions)
                                        <tr>
                                            <td><input type="checkbox" class="permissions select_groups"
                                                       id={{$group}} data-group={{ $group }}></td>
                                            <td>{{$group}}</td>
                                            <td>
                                                @if(is_array($permissions))
                                                    @foreach($permissions as  $name => $permissions)
                                                        {{Form::checkbox('permission[]', $name, $permission_helper->hasPermission($model, $name),['class' => 'each_permission permissions '.$group.'','data-parent' => $group])}} {{$permissions}}
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group form-material">
                            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
