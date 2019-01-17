<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('pagination', 'Per page pagination', ['class' => 'control-label' ]) }}
            {{ Form::number('pagination', isset($settings['pagination'])?$settings['pagination']:'', [
                    'class' => 'form-control',
                    'min' => 0
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('footer-content', 'Footer Content', ['class' => 'control-label' ]) }}
            {{ Form::textarea('footer-content', isset($settings['footer-content'])?$settings['footer-content']:'', [
                    'class' => 'form-control editor',
                ]) }}
        </div>
    </div>


    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('elastic_search', 'Elastic Search', ['class' => 'control-label' ])  }}
            {{ Form::hidden('maintenance_mode', 0) }}
            <label class="switch">
                {{ Form::checkbox('elastic_search', '1', isset($settings['elastic_search'])?$settings['elastic_search']:'') }}
                <div class="slider round"></div>
            </label>
        </div>
    </div>


    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>