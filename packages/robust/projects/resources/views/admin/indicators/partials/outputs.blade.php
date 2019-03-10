<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('morphable_id', 'Output', ['class' => 'control-label required' ]) }}
        {{ Form::select('morphable_id', $project_helper->getOutputs($parent_id), 0, [
           'class'       => 'form-control'
       ]) }}
    </div>
</div>
{{ Form::hidden('morphable_type', 'outputs') }}