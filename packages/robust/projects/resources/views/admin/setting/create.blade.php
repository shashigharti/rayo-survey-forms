@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)

    <div class="page {{ $title }}">
        <div class="page-content">
            <div class="container">
                <div class="page-title">
                    <div class="rayo-breadcrumb pull-left">
                        <span><h3>{{ $title }}</h3></span>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Workflow</a></li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </div>
                </div>

                @include("core::admin.partials.tabs.tabs")
                <div class="panel form-panel">


                    @include("core::admin.partials.messages.info")
                    <div class="panel-body panel-box default-form">

                        {{--MICRO BENIFICIARIES--}}
                        <h4>Micro Beneficiaries</h4>
                        @set('model_micro_benificiaries', new Robust\Projects\Models\MicroBenificiary)
                        @if(\Session::has('model_micro_benificiaries'))
                            @set('model_micro_benificiaries', \Session::get('model_micro_benificiaries'))
                        @endif
                        @set('ui_micro_benificiaries', new Robust\Projects\UI\MicroBenificiary)
                        {{ Form::model($model_micro_benificiaries, ['route' => $ui_micro_benificiaries->getRoute($model_micro_benificiaries), 'method' => $ui_micro_benificiaries->getMethod($model_micro_benificiaries)])}}

                        <div class="form-group form-material row">
                            <div class="col-sm-5">
                                {{ Form::text('name', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Name',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            <div class="col-sm-5">
                                {{ Form::text('description', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Description',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            {{ Form::hidden('model', 'Robust\Projects\Models\MicroBenificiary') }}
                            {{ Form::hidden('project_id', $model->id) }}
                            <div class="com-sm-2">
                                {{ Form::submit($ui_micro_benificiaries->getSubmit($model_micro_benificiaries), ['class' => 'btn btn-primary theme-btn']) }}

                            </div>
                        </div>
                        {{Form::close()}}

                        @include('core::admin.layouts.sub-layouts.partials.tables.table-data', ['records' => (new \Robust\Projects\Models\MicroBenificiary())->where('project_id', $model->id)->paginate(), 'ui' => new \Robust\Projects\UI\MicroBenificiary()])

                        {{--ORGANIZATION TYPES--}}
                        <h4>Organization Types</h4>

                        @set('model_organization_types', new Robust\Projects\Models\OrganizationType)
                        @if(\Session::has('model_organization_types'))
                            @set('model_organization_types', \Session::get('model_organization_types'))
                        @endif
                        @set('ui_organization_types', new Robust\Projects\UI\OrganizationType)
                        {{ Form::model($model_organization_types, ['route' => $ui_organization_types->getRoute($model_organization_types), 'method' => $ui_organization_types->getMethod($model_organization_types)])}}

                        <div class="form-group form-material row">
                            <div class="col-sm-5">
                                {{ Form::text('name', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Name',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            <div class="col-sm-5">
                                {{ Form::text('description', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Description',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            {{ Form::hidden('model', 'Robust\Projects\Models\OrganizationType') }}
                            {{ Form::hidden('project_id', $model->id) }}
                            <div class="com-sm-2">
                                {{ Form::submit($ui_organization_types->getSubmit($model_organization_types), ['class' => 'btn btn-primary theme-btn']) }}

                            </div>
                        </div>
                        {{Form::close()}}

                        @include('core::admin.layouts.sub-layouts.partials.tables.table-data', ['records' => (new \Robust\Projects\Models\OrganizationType())->where('project_id', $model->id)->paginate(), 'ui' => new \Robust\Projects\UI\OrganizationType()])

                        {{--BENIFICIARY TYPES--}}
                        <h4>Beneficiary Types</h4>

                        @set('model_benificiary_types', new Robust\Projects\Models\BenificiaryType)
                        @if(\Session::has('model_benificiary_types'))
                            @set('model_benificiary_types', \Session::get('model_benificiary_types'))
                        @endif
                        @set('ui_benificiary_types', new Robust\Projects\UI\BenificiaryType)
                        {{ Form::model($model_benificiary_types, ['route' => $ui_benificiary_types->getRoute($model_benificiary_types), 'method' => $ui_benificiary_types->getMethod($model_benificiary_types)])}}

                        <div class="form-group form-material row">
                            <div class="col-sm-5">
                                {{ Form::text('name', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Name',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            <div class="col-sm-5">
                                {{ Form::text('description', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Description',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            {{ Form::hidden('model', 'Robust\Projects\Models\BenificiaryType') }}
                            {{ Form::hidden('project_id', $model->id) }}
                            <div class="com-sm-2">
                                {{ Form::submit($ui_benificiary_types->getSubmit($model_benificiary_types), ['class' => 'btn btn-primary theme-btn']) }}

                            </div>
                        </div>
                        {{Form::close()}}

                        @include('core::admin.layouts.sub-layouts.partials.tables.table-data', ['records' => (new \Robust\Projects\Models\BenificiaryType())->where('project_id', $model->id)->paginate(), 'ui' => new \Robust\Projects\UI\BenificiaryType()])

                        {{--REGISTRATION TYPES--}}
                        <h4>Registration Types</h4>

                        @set('model_registration_types', new Robust\Projects\Models\RegistrationType)
                        @if(\Session::has('model_registration_types'))
                            @set('model_registration_types', \Session::get('model_registration_types'))
                        @endif
                        @set('ui_registration_types', new Robust\Projects\UI\RegistrationType)
                        {{ Form::model($model_registration_types, ['route' => $ui_registration_types->getRoute($model_registration_types), 'method' => $ui_registration_types->getMethod($model_registration_types)])}}

                        <div class="form-group form-material row">
                            <div class="col-sm-5">
                                {{ Form::text('name', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Name',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            <div class="col-sm-5">
                                {{ Form::text('description', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Description',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            {{ Form::hidden('model', 'Robust\Projects\Models\RegistrationType') }}
                            {{ Form::hidden('project_id', $model->id) }}
                            <div class="com-sm-2">
                                {{ Form::submit($ui_registration_types->getSubmit($model_registration_types), ['class' => 'btn btn-primary theme-btn']) }}

                            </div>
                        </div>
                        {{Form::close()}}

                        @include('core::admin.layouts.sub-layouts.partials.tables.table-data', ['records' => (new \Robust\Projects\Models\RegistrationType())->where('project_id', $model->id)->paginate(), 'ui' => new \Robust\Projects\UI\RegistrationType()])

                        {{--M&E TYPES--}}
                        <h4>M&E Types</h4>

                        @set('model_mne_types', new Robust\Projects\Models\MNEType)
                        @if(\Session::has('model_mne_types'))
                            @set('model_mne_types', \Session::get('model_mne_types'))
                        @endif
                        @set('ui_mne_types', new Robust\Projects\UI\MNEType)
                        {{ Form::model($model_mne_types, ['route' => $ui_mne_types->getRoute($model_mne_types), 'method' => $ui_mne_types->getMethod($model_mne_types)])}}

                        <div class="form-group form-material row">
                            <div class="col-sm-5">
                                {{ Form::text('name', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Name',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            <div class="col-sm-5">
                                {{ Form::text('description', null, [
                                        'class'       => 'form-control',
                                        'placeholder' => 'Description',
                                        'required'    => 'required',
                                    ]) }}
                            </div>
                            {{ Form::hidden('model', 'Robust\Projects\Models\MNEType') }}
                            {{ Form::hidden('project_id', $model->id) }}
                            <div class="com-sm-2">
                                {{ Form::submit($ui_mne_types->getSubmit($model_mne_types), ['class' => 'btn btn-primary theme-btn']) }}

                            </div>
                        </div>
                        {{Form::close()}}

                        @include('core::admin.layouts.sub-layouts.partials.tables.table-data', ['records' => (new \Robust\Projects\Models\MNEType())->where('project_id', $model->id)->paginate(), 'ui' => new \Robust\Projects\UI\MNEType()])


                    </div>

                </div>
            </div>
        </div>
    </div>
    @include("core::admin.partials.modals.modal")
    @include("core::admin.partials.modals.crud")
@endsection
