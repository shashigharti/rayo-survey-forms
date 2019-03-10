@inject('project_helper', 'Robust\Projects\Helpers\ProjectHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])
{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}

<ul class="nav nav-tabs left-nav">
    <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
    <li><a data-toggle="tab" href="#measurement">Measurement</a></li>

</ul>

<div class="tab-content">
    <div id="details" class="tab-pane fade in active">

        <fieldset>
            <legend>Indicator Details</legend>
            <div class="form-group form-material row">
                @include("projects::admin.ajax.indicators.partials.{$query_params['type']}")

                <div class="col-sm-6">
                    {{ Form::label('parent_id', 'Parent Indicator', ['class' => 'control-label' ]) }}
                    {{ Form::select('parent_id', ['0' => 'Select Parent Indicators'], 0, [
                       'class'       => 'form-control',
                      'id' => 'logframe-parent-field',

                       'data-numbering-url'  => route('admin.projects.log-frame.parent-numbering', ['type' => 'indicator'])
                   ]) }}
                </div>
            </div>
            <div class="form-group form-material row">
                <div class="col-sm-12">
                    {{ Form::label('name', 'Indicator', ['class' => 'control-label required' ]) }}
                    {{ Form::textarea('name', null, [
                            'class'       => 'form-control',
                            'placeholder' => 'Indicator i.e. \' Marks Received\'',
                            'required'    => 'required',
                            'rows' => 3
                        ]) }}
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Registration Details</legend>
            <div class="form-group form-material row">
                <div class="col-sm-12">
                    {{ Form::label('name', 'Registration', ['class' => 'control-label required' ]) }}
                    {{ Form::select('registration',$ui->getRegistrationFields($parent_id), null,[
                            'class'       => 'form-control',
                            'required'    => 'required',
                        ]) }}
                </div>
            </div>

            <div class="form-group form-material clearfix">
                <h5>Target Groups</h5>

                <div class="form-group col-md-12">
                    <input type="radio" id="All" name="target_id" value="0"
                           @if($model && $model['target_id'] == 0) checked @endif>
                    {{ Form::label('All', 'All Targets', ['class' => 'control-label' ]) }}

                    @foreach($ui->getTargetGroups($parent_id) as $each_target)
                        <input type="radio" id="{{ $each_target['name'] }}" name="target_id"
                               @if($model && $model['target_id'] == $each_target['id']) checked @endif
                               value="{{ $each_target['id'] }}">
                        {{ Form::label($each_target['name'], $each_target['name'], ['class' => 'control-label' ]) }}

                    @endforeach

                </div>
            </div>
        </fieldset>

        <input type="hidden" name="numbering" id="numbering">
    </div>
    <div id="measurement" class="tab-pane fade in">
        <div class="indicator-property_area">
            <div class="form-group form-material row">
                <div class="col-sm-6">
                    {{ Form::label('type', 'Type', ['class' => 'control-label required' ]) }}
                    {{ Form::select('type', $model->getTypes(), null, [
                       'class'       => 'form-control indicator-type',
                       'data-url'   => route('admin.projects.indicators.properties', $model['id'])
                   ]) }}
                </div>

                <div class="col-sm-6">
                    {{ Form::label('baseline', 'Baseline Value', ['class' => 'control-label' ]) }}
                    {{ Form::text('baseline', null, [
                       'class'       => 'form-control'
                   ]) }}
                </div>
            </div>
        </div>

    </div>
</div>

{{ Form::hidden('referer', route('admin.projects.log-frame', [$parent_id])) }}
{{ Form::hidden('project_id', $parent_id) }}
<div class="form-group form-material col-sm-12">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}
