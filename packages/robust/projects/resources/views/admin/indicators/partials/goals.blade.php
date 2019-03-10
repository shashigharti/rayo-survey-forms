<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('morphable_id', 'Goal', ['class' => 'control-label required' ]) }}
        {{ Form::select('morphable_id', $project_helper->getGoals($parent_id), 0, [
           'class'       => 'form-control'
       ]) }}
    </div>
</div>
{{ Form::hidden('morphable_type', 'goals') }}