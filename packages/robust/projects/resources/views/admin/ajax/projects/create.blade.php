@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('name', 'Project Name', ['class' => 'control-label' ]) }}
        {{ Form::text('name', null, [
                'class'       => 'form-control name',
                'placeholder' => 'Project Name i.e. \'KISAN\'',
                'required'    => 'required',
                'data-slug' => 'slug'
            ]) }}
    </div>
    <div class="col-sm-6">
        {{ Form::label('slug', 'Slug', ['class' => 'control-label required' ]) }}
        {{ Form::text('slug', null, [
            'class'       => 'form-control slug',
            'placeholder' => 'slug i.e. \'slug\''
        ]) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('start_date', 'Start Date', ['class' => 'control-label required' ]) }}
        {{ Form::text('start_date', null, [
                'class'       => 'form-control datepicker'
            ]) }}
    </div>
    <div class="col-sm-6">
        {{ Form::label('end_date', 'End Date', ['class' => 'control-label required' ]) }}
        {{ Form::text('end_date', null, [
                'class'       => 'form-control datepicker'
            ]) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-sm-6">
        {{ Form::label('type', 'Project Type', ['class' => 'control-label required' ]) }}
        {{ Form::text('type', null, [
           'class'       => 'form-control',
           'placeholder' => 'Form Type i.e. \'Community\'',
       ]) }}
    </div>

    <div class="col-sm-6">
        {{ Form::label('code', 'Project Code', ['class' => 'control-label' ]) }}
        {{ Form::text('code', null, [
            'class'       => 'form-control',
            'placeholder' => 'Project Code  i.e. \'1417-02JD|NA\'',
        ]) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('period', 'Period', ['class' => 'control-label' ]) }}
        {{ Form::text('period', null, [
           'class'       => 'form-control',
           'placeholder' => 'Period',
       ]) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-sm-12">
        {{ Form::label('description', 'Description', ['class' => 'control-label' ]) }}
        {{ Form::textarea('description', null, [
               'class'       => 'form-control',
               'placeholder' => 'Project Description'
           ]) }}
    </div>
</div>
<div class="form-group form-material">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>
{{ Form::close() }}















