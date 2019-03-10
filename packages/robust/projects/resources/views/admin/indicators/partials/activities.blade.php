<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('morphable_id', 'Activity', ['class' => 'control-label required' ]) }}
        {{ Form::select('morphable_id', $project_helper->getActivities($parent_id), 0, [
           'class'       => 'form-control'
       ]) }}
    </div>
</div>
{{ Form::hidden('morphable_type', 'activities') }}