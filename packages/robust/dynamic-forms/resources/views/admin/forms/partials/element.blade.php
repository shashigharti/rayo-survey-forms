@inject('form_helper', '\Robust\DynamicForms\Helpers\FormHelper')
<div class="form-group dynamic-form__form-element ui-sortable {{(isset($count) && ($count == 0))?'ui-selected':''}}"
     data-id="{{ $field->id }}"
     data-name="{{ $field->name }}"
     data-type="{{ $field->type }}"
     data-order="{{ $field->order }}"
     data-property-url="{{route('admin.forms.fields.properties',[$field->id])}}"
>
    @include("dynamic-forms::admin.forms.partials.right-toolbox")
    @set('properties', json_decode($field->properties))
    @include("dynamic-forms::admin.forms.design.$field->type")
</div>