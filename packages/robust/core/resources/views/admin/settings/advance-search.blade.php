<div class="system-settings__advance-search">
    {{ Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()]) }}
    {{ Form::hidden('slug', $slug, [ 'class' => 'form-control' ]) }}
    <fieldset>
        <legend>Advance Search Filters</legend>
        <div class="row multi-select-container">
            <div class="col s6">
                {{ Form::label('first_block', 'First Block', ['class' => 'control-label' ]) }}
                {{ Form::select('first_block[]', [],
                   $settings['first_block'] ?? [],
                    [
                        'class'=>'browser-default multi-select',
                        'multiple'
                    ])
                }}
            </div>
            <div class="col s6">
                {{ Form::label('second_block', 'Second Block', ['class' => 'control-label' ]) }}
                {{ Form::select('second_block[]', [],
                    $settings['second_block'] ?? [],
                    [
                        'class'=>'browser-default multi-select',
                        'multiple'
                    ])
                }}
            </div>
        </div>
        <div class="row multi-select-container mt-1">
            <div class="col s6">
                {{ Form::label('third_block', 'Third Block', ['class' => 'control-label' ]) }}
                {{ Form::select('third_block[]', [],
                    $settings['third_block'] ?? [],
                    [
                        'class'=>'browser-default multi-select',
                        'multiple'
                    ])
                }}
            </div>
            <div class="col s6">
                {{ Form::label('fourth_block', 'Fourth Block', ['class' => 'control-label' ]) }}
                {{ Form::select('fourth_block[]',  [],
                    $settings['fourth_block'] ?? [],
                    [
                    'class'=>'browser-default multi-select',
                    'multiple'
                    ])
                }}
            </div>
        </div>
        <fieldset class="mt-3">
            <legend>Sort Block Filters</legend>
            <div class="col s3 sort-container__root">
                <legend>First Block</legend>
                <ul class="collection sort-container__list" data-update-item="first_block_order">
                    @foreach(sort_array_by_array($settings['first_block'], explode(',', $settings['first_block_order'] ?? '')) as $key => $first_block_item)
                        <li class="sort-container__item collection-item"
                            data-id="{{ $first_block_item }}"
                            data-order="{{ $key }}"
                        >
                            <i class="sort-container__handle material-icons">zoom_out_map</i> {{ $first_block_item }}
                        </li>
                    @endforeach
                    {{ Form::hidden('first_block_order', $settings['first_block_order'] ?? '') }}
                </ul>
            </div>
            <div class="col s3 sort-container__root">
                <legend>Second Block</legend>
                <ul class="collection sort-container__list" data-update-item="second_block_order">
                    @foreach(sort_array_by_array($settings['second_block'], explode(',', $settings['second_block_order'] ?? '')) as $key => $second_block_item)
                        <li class="sort-container__item collection-item"
                            data-id="{{ $second_block_item }}"
                            data-order="{{ $key }}"
                        >
                            <i class="sort-container__handle material-icons">zoom_out_map</i> {{ $second_block_item }}
                        </li>
                    @endforeach
                    {{ Form::hidden('second_block_order', $settings['second_block_order'] ?? '') }}
                </ul>
            </div>
            <div class="col s3 sort-container__root">
                <legend>Third Block</legend>
                <ul class="collection sort-container__list" data-update-item="third_block_order">
                    @foreach(sort_array_by_array($settings['third_block'],explode(',', $settings['third_block_order'] ?? '')) as $key => $third_block_item)
                        <li class="sort-container__item collection-item"
                            data-id="{{ $third_block_item }}"
                            data-order="{{ $key }}"
                        >
                            <i class="sort-container__handle material-icons">zoom_out_map</i> {{ $third_block_item }}
                        </li>
                    @endforeach
                    {{ Form::hidden('third_block_order', $settings['third_block_order'] ?? '') }}
                </ul>
            </div>
            <div class="col s3 sort-container__root">
                <legend>Fourth Block</legend>
                <ul class="collection sort-container__list" data-update-item="fourth_block_order">
                    @foreach(sort_array_by_array($settings['fourth_block'],explode(',', $settings['fourth_block_order'] ?? '')) as $key => $fourth_block_item)
                        <li class="sort-container__item collection-item"
                            data-id="{{ $fourth_block_item }}"
                            data-order="{{ $key }}"
                        >
                            <i class="sort-container__handle material-icons">zoom_out_map</i> {{ $fourth_block_item }}
                        </li>
                    @endforeach
                    {{ Form::hidden('fourth_block_order', $settings['fourth_block_order'] ?? '') }}
                </ul>
            </div>
        </fieldset>
    </fieldset>
    <div class="form-group form-material mt-3 row">
        <div class="col s12">
            {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
