@inject('project_helper', 'Robust\Projects\Helpers\ProjectHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('name', 'Title', ['class' => 'control-label required' ]) }}
        {{ Form::text('name', null, [
                'class'       => 'form-control name',
                'placeholder' => 'M&E Title i.e. \' Evaluation of \'',
                'required'    => 'required'
            ]) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('type', 'Type', ['class' => 'control-label required' ]) }}
        {{ Form::select('type', $ui->getTypes($parent_id), null, [
                'class'       => 'form-control',
                'required'    => 'required'
            ]) }}
    </div>
</div>

<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('start_date', 'Start Date', ['class' => 'control-label required' ]) }}
        {{ Form::date('start_date', null, [
                'class'       => 'form-control',
                'required'    => 'required'
            ]) }}
    </div>

    <div class="col-sm-6">
        {{ Form::label('end_date', 'End Date', ['class' => 'control-label required' ]) }}
        {{ Form::date('end_date', null, [
                'class'       => 'form-control',
                'required'    => 'required'
            ]) }}
    </div>
</div>


<fieldset>
    <legend>Filter</legend>

    <div class="form-group form-material row">
        {{--<div class="col-sm-6">--}}
        {{--{{ Form::select('filter_type', $ui->getIndicatorParents(), null,[--}}
        {{--'class'    => 'form-control',--}}
        {{--'id' => 'indicator-parent-field',--}}
        {{--'data-super-parent-url' => route('admin.projects.indicator-parent')--}}
        {{--]) }}--}}
        {{--<div class="selected-filters_badge">--}}

        {{--</div>--}}
        {{--</div>--}}

        <div class="col-sm-6">
            {{ Form::select('filter_type', $ui->getRegistrationTypes($parent_id), null,[
            'class'    => 'form-control',
            'id' => 'indicator-parent-field',
            'data-super-parent-url' => route('admin.projects.indicator-parent', $parent_id),
            'data-filter'=> 'registration_type'
            ]) }}
            {{--<div class="selected-filters_badge">--}}

            {{--</div>--}}
        </div>
        <div class="col-sm-6">
            {{ Form::select('target_groups', ['0' => 'All Target Groups'] + $ui->getTargetGroups(), null,[
                    'class'    => 'form-control',
                    'id' => 'target-group-filter',
                    'data-filter-url' => route('admin.projects.target-group-indicator', $parent_id)
                ]) }}
        </div>

        {{--<input type="text" class="selected_filters">--}}

    </div>

    <table class="table table-body form-table" id="indicator_filter-table">
        <tr>
            <th><input type="checkbox" class="select_all_checkboxes"></th>
            <th>Number</th>
            <th>Indicator</th>
            <th>Type</th>
            <th>Target Value</th>
            <th>Target Population</th>
            <th>Data Type</th>
        </tr>
        <tbody id="indicator_filter-table-data" data-selected="{{ $ui->getSelectedIndicators($model) }}">

        </tbody>
    </table>

</fieldset>

{{ Form::hidden('referer', route('admin.projects.monitorings.get-project-monitorings', [$parent_id])) }}
{{ Form::hidden('project_id', $parent_id) }}
{{ Form::hidden('relation_type', 'indicators') }}
<div class="form-group form-material">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}
















