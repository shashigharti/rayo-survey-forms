@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)
    <div id="form_create">
        {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
        <input type="hidden" name="base_url" value="{{url('/')}}">
        <div class="form-group form-material row">
            <div class="col-sm-6">
                {{ Form::label('title', 'Form Name', ['class' => 'control-label' ])}}
                <input type="text" name="title" class="form-control name" value="{{$model->title ?? ''}}"
                       placeholder="Form Name i.e. \'KISAN\'"
                       required='required'>
            </div>
            <div class="col-sm-6">
                {{ Form::label('slug', 'Slug', ['class' => 'control-label' ])}}
                <input type="text" name="slug" class="form-control" value="{{$model->slug ?? ''}}"
                       required='required'>
            </div>
        </div>

        @if(isset($model->id))
            <div class="form-group form-material row">
                <div class="col-sm-3">
                    {{ Form::checkbox('notify_to_user', $model->notify_to_user, null, [
                       ($model->notify_to_user == 1)? 'Checked' : '', 'class' => 'user_email_check'
                       ]) }}
                    {{ Form::label('notify_to_user', 'Notify to user', ['class' => 'control-label' ]) }}
                </div>
                <div class="col-sm-3">
                    {{ Form::checkbox('single_submit', $model->single_submit, null, [
                        ($model->single_submit    == 1)? 'Checked' : ''
                        ]) }}
                    {{ Form::label('single_submit', 'Single submit', ['class' => 'control-label' ]) }}
                </div>
                <div class="col-sm-3">
                    {{ Form::checkbox('make_public', $model->make_public, null, [
                       ($model->make_public== 1)? 'Checked' : '', 'class' => 'make-public'
                       ]) }}
                    {{ Form::label('make_public', 'Make Public', ['class' => 'control-label' ]) }} &nbsp;&nbsp;&nbsp;
                    <span class="public-link"
                          style="display:none">{{ route('user.form', $model->slug) }}</span>
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-12 user_email_field">
                    <div class="form-group {{ $errors->has('field_for_user_email') ? 'has-error' : '' }}">
                        {{ Form::label('field_for_user_email', 'Field for User Email', ['class' => 'control-label' ]) }}
                        {{ Form::select("field_for_user_email", $ui->getEmailFields($model), $model->field_for_user_email,[
                            'class' => 'form-control'
                        ])}}
                    </div>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        You will have to fill in the <b>Field for User Email</b> in case <b>Notify to
                            User Group</b> is checked
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group form-material">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
        {{Form::close()}}
    </div>
@endsection
