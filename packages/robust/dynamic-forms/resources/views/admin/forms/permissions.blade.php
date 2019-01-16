@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)

    <div id="form_permission">
        <input type="hidden" name="base_url" value="{{url('/')}}">
        <fieldset>
            <legend>Roles:</legend>
            <v-select tabindex="1" v-model="selected_roles" :options="available_roles"
                      placeholder="Comma Separated Value For Options E.g, Manager, Accountant" multiple></v-select>
            <input type="hidden" name="roles"  value="{{json_encode($model->roles()->pluck('id'))}}">
        </fieldset>
        <fieldset>
            <legend>Users:</legend>
            <v-select tabindex="2" v-model="selected_users" :options="available_users"
                      placeholder='Comma Separated Value For Options E.g, Rita, Michelle' multiple></v-select>
            <input type="hidden" name="users" value="{{json_encode($model->users()->pluck('id'))}}">
            <input type="hidden" name="form_id" value="{{$model->id}}">
        </fieldset>
    </div>
@endsection
