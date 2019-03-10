@inject('project_helper', 'Robust\Projects\Helpers\ProjectHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])
{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}


<div class="form-group form-material row">
    @include("projects::admin.ajax.assumptions.partials.{$query_params['type']}")
</div>
<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('assumption', 'Assumption', ['class' => 'control-label required' ]) }}
        {{ Form::textarea('assumption', null, [
                'class'       => 'form-control',
                'placeholder' => 'Indicator i.e. \' Marks Received\'',
                'required'    => 'required',
                'rows' => 3
            ]) }}
    </div>
</div>
<input type="hidden" name="numbering" id="numbering">
<input type="hidden" value="0" name="parent_id">
{{ Form::hidden('referer', route('admin.projects.log-frame', [$parent_id])) }}
{{ Form::hidden('project_id', $parent_id) }}
<div class="form-group form-material col-sm-12">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}
