@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

<div class="">
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}

    <fieldset>
        <legend>Organization Details</legend>
        <div class="form-group form-material row">
            <div class="col-sm-12 col-md-6">
                {{ Form::label('name', 'Name', ['class' => 'control-label required' ]) }}
                {{ Form::text('name', null, [
                        'class'       => 'form-control name',
                        'placeholder' => 'Name i.e. \'Sanjal\'',
                        'required'    => 'required'
                    ]) }}
            </div>

            <div class="col-sm-12 col-md-6">
                {{ Form::label('acronym', 'Acronym', ['class' => 'control-label required' ]) }}
                {{ Form::text('acronym', null, [
                        'class'       => 'form-control name',
                        'placeholder' => 'Acronym i.e. \'REED\'',
                        'required'    => 'required'
                    ]) }}
            </div>
        </div>

        <div class="form-group form-material row">
            <div class="col-sm-12 col-md-6">
                {{ Form::label('organization_type', 'Organization type', ['class' => 'control-label' ]) }}
                {{ Form::select('organization_type', $ui->getOrganizationTypes($parent_id), null, [
                        'class'       => 'form-control',
                        'required' => 'required'
                    ]) }}
            </div>

            <div class="col-sm-12 col-md-6">
                {{ Form::label('type', 'Role in project', ['class' => 'control-label' ]) }}
                {{ Form::select('type', $model->getTypes(), null, [
                        'class'       => 'form-control'
                    ]) }}
            </div>
        </div>

        <div class="form-group form-material row">
            <div class="col-sm-12 col-md-12">
                {{ Form::label('description', 'Description', ['class' => 'control-label' ]) }}
                {{ Form::textarea('description', null, [
                        'class'       => 'form-control'
                    ]) }}
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Contact Person Details</legend>

        <div class="form-group form-material row">

            <div class="col-sm-12 col-md-6">
                {{ Form::label('contact_person', 'Contact Person', ['class' => 'required control-label' ]) }}
                {{ Form::text('contact_person', null, [
                        'class'       => 'form-control',
                        'required'    => 'required'

                    ]) }}
            </div>

            <div class="col-sm-12 col-md-6">
                {{ Form::label('contact_number', 'Contact Number', ['class' => 'required control-label' ]) }}
                {{ Form::text('contact_number', null, [
                        'class'       => 'form-control',
                        'required'    => 'required'

                    ]) }}
            </div>
        </div>
        <div class="form-group form-material row">

            <div class="col-sm-12 col-md-6">
                {{ Form::label('contact_email', 'Email', ['class' => 'required control-label' ]) }}
                {{ Form::email('contact_email', null, [
                        'class'       => 'form-control',
                        'required'    => 'required'

                    ]) }}
            </div>

            <div class="col-sm-12 col-md-6">
                {{ Form::label('contact_address', 'Contact Address', ['class' => 'required control-label' ]) }}
                {{ Form::text('contact_address', null, [
                        'class'       => 'form-control',
                        'required'    => 'required'

                    ]) }}
            </div>
        </div>

        <div class="form-group form-material row">
            <div class="col-sm-12 col-md-12">
                {{ Form::label('designation', 'Designation', ['class' => 'control-label' ]) }}
                {{ Form::text('designation', null, [
                        'class'       => 'form-control'
                    ]) }}
            </div>
        </div>
    </fieldset>

    {{ Form::hidden('referer', route('admin.projects.partners.get-project-partners', [$parent_id])) }}
    {{ Form::hidden('project_id', $parent_id)}}
    <div class="form-group form-material row">
        <input class="btn btn-primary theme-btn" value="Save changes" type="submit">
        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>

    </div>
    {{ Form::close() }}
</div>