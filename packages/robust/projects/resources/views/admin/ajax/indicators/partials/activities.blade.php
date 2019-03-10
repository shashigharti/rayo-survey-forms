<div class="col-sm-6">
    {{ Form::label('morphable_id', 'Activity', ['class' => 'control-label required' ]) }}
    {{ Form::select('morphable_id', $project_helper->getActivities($parent_id), 0, [
       'class'       => 'form-control',
       'id'         => 'indicator-parent-field',
       'data-parent-type' => 'activities',
       'data-numbering-url' => route('admin.projects.log-frame.maxid', ['type' => 'indicator']),
       'data-parent-url' => route('admin.projects.indicator-parent')

   ]) }}
</div>

{{ Form::hidden('morphable_type', 'activities') }}
{{ Form::hidden('indicatable_type_name', 'Activities') }}