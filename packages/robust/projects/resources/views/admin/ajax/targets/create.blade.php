@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('name', 'Target Group Name', ['class' => 'control-label required' ]) }}
        {{ Form::text('name', null, [
                'class'       => 'form-control name',
                'placeholder' => 'Target Group Name i.e. \'Farmer Association\'',
                'required'    => 'required',
                'data-slug' => 'slug'
            ]) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('type', 'Type', ['class' => 'control-label required' ]) }}
        {{ Form::select('type', $ui->getTypes($parent_id), null, [
                'class'       => 'form-control',
                'required'    => 'required'
            ]) }}
    </div>

    <div class="col-sm-6">
        {{ Form::label('number_of_beneficiaries', 'Number of Beneficiaries', ['class' => 'control-label required' ]) }}
        {{ Form::text('number_of_beneficiaries', null, [
                'class'       => 'form-control',
                'required'    => 'required'
            ]) }}
    </div>
</div>
@if($model->exists)
    @set('micro_beneficiaries_val', json_decode($model->micro_beneficiaries, TRUE))
@endif

@set('micro_beneficiaries', $ui->getMicroBeneficiaries($parent_id))
<div class="form-group form-material row">

    @foreach($micro_beneficiaries as $beneficiary)
        <div class="col-sm-4">
            {{ Form::label('micro_beneficiaries', $beneficiary->name, ['class' => 'control-label' ]) }}
            {{ Form::number('micro_beneficiaries['.$beneficiary->name.']', (isset($micro_beneficiaries_val) && isset($micro_beneficiaries_val[$beneficiary->name])) ? $micro_beneficiaries_val[$beneficiary->name]: '', [
                    'class'       => 'form-control',
                ]) }}
        </div>
    @endforeach
</div>

<fieldset>
    <h3>Beneficiary identification fields</h3>

    <div class="form-group form-material clearfix">
        <div class="form-group col-md-5">
            {{ Form::label('others', 'Fields', ['class' => 'control-label' ]) }}
            {{ Form::select('identification_fields_list', $ui->getIdentificationFields($model),null ,[
            'class' => 'drag__drop-multiselect',
            'id' => 'select_source',
            'multiple' => 'multiple'
            ]) }}
        </div>
        <div class="col-md-2 text-center drag__drop-buttons">
            <span><a href="javascript:void(0)" id="add_to_destination" class="btn theme-btn">&gt;&gt;</a></span>
            <span><a href="#" id="remove_from_destination" class="btn theme-btn"> &lt;&lt;</a></span>

        </div>
        <div class="form-group col-md-5">
            {{ Form::label('identification_fields', 'Selected', ['class' => 'control-label' ]) }}
            {{ Form::select('identification_fields[]',  $ui->getSelectedIdentificationFields($model), $ui->getSelectedIdentificationFieldsValue($model) ,[
            'class' => 'drag__drop-multiselect',
            'id' => 'select_destination',
            'multiple' => 'multiple'
            ]) }}
        </div>
    </div>
</fieldset>
{{ Form::hidden('referer', route('admin.projects.targets.get-project-targets', [$parent_id])) }}
{{ Form::hidden('project_id', $parent_id) }}
<div class="form-group form-material">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}















