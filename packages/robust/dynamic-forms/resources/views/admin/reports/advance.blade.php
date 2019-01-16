@extends('core::admin.layouts.sub-layouts.report')
@section('report_body')
    {{ Form::open(['route' => 'admin.forms.reports.generate', 'method' => 'POST', 'target' => '_blank']) }}
    <div class="report__advance" id="report__advance"
         data-form-url="{{route('admin.ajax.forms.index')}}"
         data-base-url="{{url('/')}}"
         data-field-url="{{route('admin.ajax.fields.index')}}"
    >
        <div class="report_query-designer">
            <div class="form-group form-material col-sm-6">
                <div class="report-block">
                    <label class="control-label">Projects</label>
                    <v-select tabindex="1" v-model="selected_project" :options="projects"></v-select>
                </div>
                <div class="report-block">
                    <label class="control-label required">Forms</label>
                    <v-select tabindex="1" v-model="selected_form" :options="forms"></v-select>
                </div>
                <div class="report-block">
                    <label>Fields</label>
                    <select v-model="field" multiple>
                        <option v-for="field in fields" :value="field.value">
                            @{{ field.label }}
                        </option>
                    </select>
                </div>
                <div class="report-block">
                    <label>Order By</label>
                    <v-select v-model="order_by" multiple :options="fields"></v-select>
                </div>
            </div>
            <div class="form-group form-material report-block col-sm-6">
                <div class="col-sm-12"><label>Conditions</label></div>
                <div class="col-sm-6">
                    <select v-model="condition_field">
                        <option v-for="field in fields" :value="field.value">
                            @{{ field.label }}
                        </option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <input v-model="condition_value" type="text">
                    <input class="pull-right" type="button" value="+" @click="addNewCondition">
                </div>
                <div class="col-sm-12">
                    <table class="table report__conditions">
                        <thead>
                        <tr>
                            <th>Condition</th>
                            <th>Operator</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(condition, index) in conditions">
                            <td class="col-sm-7">@{{ getConditionName(condition.field) }}</td>
                            <td class="col-sm-1">=</td>
                            <td class="col-sm-4">@{{ condition.value }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 text-right">
                <input type="hidden" name="fields" v-model="search_data.fields">
                <input type="hidden" name="all_fields" v-model="all_fields">
                <input type="hidden" name="order_by" v-model="search_data.order_by">
                <input type="hidden" name="conditions" v-model="search_data.conditions">
                <input type="submit" value="Display Report">
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection