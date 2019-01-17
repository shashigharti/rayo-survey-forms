@extends('core::admin.layouts.sub-layouts.create')
@section('form')
    @set('ui', new $ui)
    @inject('block_helper', 'Robust\Core\Helpers\BlockHelper')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model), 'id' => "outcomes_form", 'enctype' => 'multipart/form-data' ]) }}

    <div class="form__wrapper form__en">
        <div class="form-group form-material row">
            <div class="col-sm-6">
                {!! Form::label('name', 'Name', ['class' => 'required control-label' ])  !!}
                {{ Form::text('name', null, [
                        'class'       => 'form-control name',
                        'placeholder' => 'Download Name i.e. \'KISAN\'',
                        'required'    => 'required',
                    ]) }}
            </div>
            <div class="col-sm-6">
                {!! Html::decode(Form::label('slug', 'Slug', ['class' => 'required control-label' ]))  !!}

                {{ Form::text('slug', null,
                    [
                        'class' => 'form-control slug',
                        'placeholder' => 'slug i.e. \'slug\''
                    ])
                }}
            </div>
        </div>

        <div class="form-group form-material row">
            <div class="col-sm-12">
                {!! Form::label('description', 'Description', ['class' => 'required control-label' ])  !!}

                {{ Form::textarea('description', null, [
                       'class'       => 'form-control editor',
                       'placeholder' => 'Discription'
                   ]) }}
            </div>
        </div>

        <div class="form-group form-material row">
            <div class="col-sm-12">
                {!! Form::label('column', 'Number of column', ['class' => 'required control-label' ])  !!}

                {{ Form::text('column', null, [
                       'class'       => 'form-control',
                       'placeholder' => 'Number of Columns',
                       'required'    => 'required',
                   ]) }}
            </div>
        </div>

        <div class="form-group form-material">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
    </div>

    </div>
    {{ Form::close() }}

@endsection

