<div class="col-sm-12">
    {{ Form::label('morphable_id', 'Activity', ['class' => 'control-label required' ]) }}
    {{ Form::select('morphable_id', $project_helper->getActivities($parent_id), 0, [
       'class'       => 'form-control',
       'id'         => 'indicator-parent-field',
       'data-parent-type' => 'activities',
       'data-numbering-url' => route('admin.projects.log-frame.maxid', ['type' => 'assumption']),

   ]) }}
</div>

{{ Form::hidden('morphable_type', 'activities') }}