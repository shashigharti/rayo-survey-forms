<div class="alert alert-success" style="display:none">
</div>


{{--{{ Form::model($form, ['route' => ['admin.forms.data.store', $form->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form dynamic-progress-form' ]) }}
@if(!empty($model))
    <input type="hidden" name="edit_mode" value="1">
@endif
<input type="hidden" name="status_completed" value="0">
<input type="hidden" name="is_submit_btn_clicked" value="0">
<input type="hidden" name="data_id" value="{{$model['data_id'] or 0}}">
<input type="hidden" name="form_id" value="{{$form['id']}}">

{!!  $pages !!}

{{  Form::close() }}--}}
