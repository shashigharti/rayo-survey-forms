@inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
<h4>Submitted By: {{\Robust\Core\Models\User::find($records->user_id)->first_name}}</h4>
<h6>Submitted at: {{ $records->updated_at }}</h6>
@set('data', json_decode($records['values'], true))
@set('data_columns', $form_helper->setLabelInArray(json_decode($records['values'], true)))

{!! Shortcode::compile("[dyn-form preview = true data_id = {$records->id}]{$model->title}[/dyn-form]")  !!}



