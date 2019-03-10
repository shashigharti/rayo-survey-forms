@inject('project_helper', 'Robust\Projects\Helpers\ProjectHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])
{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}

<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('output_id', 'Output', ['class' => 'control-label' ]) }}
        {{ Form::select('output_id', $project_helper->getOutputs($parent_id), 0, [
           'class'       => 'form-control',
           'id' => 'logframe-super-parent-field',
           'data-parent-type' => 'outputs',
            'data-numbering-url'  => route('admin.projects.log-frame.parent-numbering', ['type' => 'activities']),
           'data-parent-url' => route('admin.projects.data-parent', ['type' => 'activities'])

       ]) }}
    </div>

    <div class="col-sm-6">
        {{ Form::label('parent_id', 'Parent Activity', ['class' => 'control-label' ]) }}
        {{ Form::select('parent_id', ['Select Parent'] + $project_helper->getActivities($parent_id), null, [
           'class'       => 'form-control',
           'id'      => 'logframe-parent-field',
           'data-numbering-url'  => route('admin.projects.log-frame.parent-numbering', ['type' => 'activities'])
       ]) }}
    </div>
</div>
{{ Form::hidden('numbering', null, ['id' => 'numbering']) }}


<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('name', 'Activity Name', ['class' => 'control-label required' ]) }}
        {{ Form::textarea('name', null, [
                'class'       => 'form-control',
                'placeholder' => 'Activity Name i.e. \' Distribute Stationaries to Students\'',
                'required'    => 'required',
                'rows' => 3
            ]) }}
    </div>
</div>

<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('type', 'Type', ['class' => 'control-label' ]) }}
        {{ Form::select('type', $model->getTypes(), 0, [
           'class'       => 'form-control'
       ]) }}
    </div>
</div>

{{ Form::hidden('referer', route('admin.projects.log-frame', [$parent_id])) }}
{{ Form::hidden('project_id', $parent_id) }}
<div class="form-group form-material col-sm-12">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}


