<div class="dynamic-form__tools">
    <i class="fa fa-arrows handle btn"></i>
    {{ Form::open(array('route' => ['admin.forms.fields.destroy', $field->id], 'method' => 'DELETE')) }}
    {{ Form::button('<i class="fa fa-times"></i>',['type' => 'submit', 'class' => 'btn',
    'data-action' => 'delete',
    'data-confirm-message' => 'Are you sure you want to delete this?' ]) }}
    {{ Form::close() }}
</div>