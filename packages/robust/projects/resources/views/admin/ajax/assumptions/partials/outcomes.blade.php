<div class="col-sm-12">
    {{ Form::label('morphable_id', 'Outcome', ['class' => 'control-label required' ]) }}
    {{ Form::select('morphable_id', $project_helper->getOutcomes($parent_id), 0, [
       'class'       => 'form-control',
       'id'         => 'indicator-parent-field',
       'data-parent-type' => 'outcomes',
       'data-numbering-url' => route('admin.projects.log-frame.maxid', ['type' => 'assumption']),

   ]) }}
</div>

{{ Form::hidden('morphable_type', 'outcomes') }}