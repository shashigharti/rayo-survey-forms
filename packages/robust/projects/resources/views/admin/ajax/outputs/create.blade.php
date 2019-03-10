@inject('project_helper', 'Robust\Projects\Helpers\ProjectHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])
{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}

<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('outcome_id', 'Outcome', ['class' => 'control-label' ]) }}
        {{ Form::select('outcome_id', $project_helper->getOutcomes($parent_id), 0, [
           'class'       => 'form-control',
           'id' => 'logframe-super-parent-field',
           'data-parent-type' => 'outcomes',
           'data-numbering-url'  => route('admin.projects.log-frame.parent-numbering', ['type' => 'outputs']),
           'data-parent-url' => route('admin.projects.data-parent', ['type' => 'outputs'])
       ]) }}
    </div>

    <div class="col-sm-6">
        {{ Form::label('parent_id', 'Parent Output', ['class' => 'control-label' ]) }}
        {{ Form::select('parent_id', ['Select Parent'] + $project_helper->getOutputs($parent_id), null, [
           'class'       => 'form-control',
            'id'      => 'logframe-parent-field',
           'data-numbering-url'  => route('admin.projects.log-frame.parent-numbering', ['type' => 'outputs'])
       ]) }}
    </div>
</div>
{{ Form::hidden('numbering', null, ['id' => 'numbering']) }}


<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('name', 'Output Name', ['class' => 'control-label required' ]) }}
        {{ Form::textarea('name', null, [
                'class'       => 'form-control',
                'placeholder' => 'Project Name i.e. \' Increase Literacy by 10%\'',
                'required'    => 'required',
                'rows' => 3
            ]) }}
    </div>
</div>
 
{{ Form::hidden('referer', route('admin.projects.log-frame', [$parent_id])) }}
{{ Form::hidden('project_id', $parent_id) }}
<div class="form-group form-material col-sm-12">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}
