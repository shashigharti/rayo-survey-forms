@extends('core::admin.layouts.sub-layouts.create')
@section('form')
    @inject('block_helper', 'Robust\Core\Helpers\BlockHelper')
    @inject('blockitem_helper', 'Robust\Core\Helpers\BlockItemHelper')
    @set('ui', new $ui)
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}

    @foreach ($block_helper->getBanners() as $key=>$banner)
        <div class="form-group form-material row">
            <div class="col-sm-12">
                {{ Form::checkbox('morphable_id[]', $key, in_array($key, $blockitem_helper->getBlockableBanners($model->id)->toArray())) }}
                {{ Form::label('banner', $banner) }}<br>
            </div>
        </div>
    @endforeach

    {{ Form::hidden('morphable_type', 'banners') }}
        <div class="form-group form-material">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
    {{ Form::close() }}

@endsection



