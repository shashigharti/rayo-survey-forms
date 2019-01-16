@if(isset($form_field->properties))
    @set('properties',json_decode($form_field->properties))
@endif
<div class="row dynamic-form__address">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($form_field->required) ? 'control-required' : '' }}">
            <label for="{{$form_field->name}}[0]">Street</label>
            <input class="form-control form-group-item" type="text"
                   name="{{$form_field->name}}[0]"
                   value="{{ isset($model[$form_field->name][0]) ? $model[$form_field->name][0] : '' }}"
                   {{ ($form_field->required) ? 'required' : "" }}
            >
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group {{ ($form_field->required) ? 'control-required' : '' }}">
            <label for="{{$form_field->name}}[1]">State</label>
            <input class="form-control form-group-item" type="text"
                   name="{{$form_field->name}}[1]"
                   value="{{ isset($model[$form_field->name][1]) ? $model[$form_field->name][1] : '' }}"
                   {{ ($form_field->required) ? 'required' : "" }}
            >
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group {{ ($form_field->required) ? 'control-required' : '' }}">
            <label for="{{$form_field->name}}[2]">Post Code</label>
            <input class="form-control form-group-item" type="text"
                   name="{{$form_field->name}}[2]"
                   value="{{ isset($model[$form_field->name][2]) ? $model[$form_field->name][2] : '' }}"
                   {{ ($form_field->required) ? 'required' : "" }}
            >
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group {{ ($form_field->required) ? 'control-required' : '' }}">
            @set('countries', $form_helper->getCountries())
            <label for="{{$form_field->name}}[3]">Country</label>
            {{ Form::select($form_field->name . '[3]', ['' => 'Please Select'] + $countries, isset($model[$form_field->name][3]) ? $model[$form_field->name][3] : '', [
                 'class' => 'form-control',
                 ($form_field->required) ? 'required' : ''
             ])
            }}
        </div>
    </div>

    @if(isset($model['coordinates']))
        @set('coordinates', $model['coordinates'])
    @endif
    {{Form::hidden('coordinates[lat]', isset($model['coordinates']['lat'])? $model['coordinates']['lat']:'')}}
    {{Form::hidden('coordinates[lng]',  isset($model['coordinates']['lng'])? $model['coordinates']['lng']:'')}}

</div>