@extends('core::admin.layouts.sub-layouts.blank')

@section('custom_design')
    <div class="log-frame-panel">
        <div class="row table-responsive">
            @foreach($records as $title => $rows)
                <div class="row table table-bordered">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 table-box">
                        <div class="panel-heading">
                            <h4>{{ucwords($title)}}</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($rows->sortBy('numbering') as $row)

                                    <li class="list-group-item clearfix">

                                        <span class="logframe-numbers">{{ $row->numbering }}</span> <span
                                                class="logframe-names">{{$row->name}}</span>
                                        <span class="del-btn">
                                            <a data-url="{{route("admin.projects.{$title}.edit",[$row['id'],'parent_id' => $model->id])}}"
                                               data-toggle="modal"
                                               data-modal="crudModal"
                                               href='javascript:void(0)'
                                            >
                                                <i class="icon md-edit" aria-hidden="true"></i>
                                            </a>
                                            {!! Form::open(['url' => route("admin.projects.{$title}.destroy", ['id' => $row->id, 'params' =>['parent_id' => isset($model)?$model->id:0]]) , 'method' => 'DELETE']) !!}
                                            {!! Form::button( '<i class="icon md-delete" aria-hidden="true"></i>',
                                                [
                                                    'type' => 'button',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#confirmDelete',
                                                    'data-title' => 'Delete',
                                                    'data-message' =>  'Are you sure you want to delete?'
                                                ])
                                            !!}
                                            {!! Form::close() !!}
                                    </span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="add-btn text-center">
                                <a data-toggle="modal"
                                   data-modal="crudModal"
                                   data-title="{{ ucwords($title) }}"
                                   data-url="{{route("admin.projects.{$title}.create",['parent_id' => $model->id])}}"
                                   data-numbering-url="{{ route('admin.projects.log-frame.maxid', ['type' => $title, 'project_id' => $model->id]) }}"
                                   href="javascript:void(0)">Add More</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 table-box">
                        <div class="panel-heading">
                            <h4>Indicators</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($rows as $row)
                                    @foreach($row->indicators as $indicator)
                                        <li class="list-group-item clearfix">
                                            <span class="logframe-numbers">{{ $indicator->numbering }}</span> <span
                                                    class="logframe-names">{{$indicator->name}}</span>

                                            <span class="del-btn">
                                        <a data-url="{{route("admin.projects.indicators.edit",[$indicator->id,'parent_id' => $model->id, 'type' => $title])}}"
                                           data-toggle="modal"
                                           data-modal="crudModal"
                                           href='javascript:void(0)'
                                        >
                                            <i class="icon md-edit" aria-hidden="true"></i>
                                        </a>

                                                {!! Form::open(['url' => route('admin.projects.indicators.destroy', ['id' => $indicator->id, 'params' =>['parent_id' => isset($model)?$model->id:0]]) , 'method' => 'DELETE']) !!}
                                                {!! Form::button( '<i class="icon md-delete" aria-hidden="true"></i>',
                                                    [
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => 'Delete Row',
                                                        'data-message' =>  'Are you sure you want to delete?'
                                                    ])
                                                !!}
                                                {!! Form::close() !!}
                                        </span>

                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                            <div class="add-btn text-center">
                                <a data-toggle="modal"
                                   data-modal="crudModal"
                                   data-title="Indicator"
                                   data-url="{{route("admin.projects.indicators.create",['parent_id' => $model->id, 'type' => $title])}}"
                                   href="javascript:void(0)">Add More</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 table-box">
                        <div class="panel-heading">
                            <h4>Assumptions</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                {{--@foreach($rows->sortBy('numbering') as $row)--}}
                                {{--<li class="list-group-item clearfix">--}}

                                {{--<span class="logframe-numbers">{{ $row->numbering }}</span> <span--}}
                                {{--class="logframe-names">{{ strip_tags($row->assumption)}}</span>--}}

                                {{--</li>--}}
                                {{--@endforeach--}}

                                @foreach($rows as $row)
                                    @foreach($row->assumptions as $assumption)
                                        <li class="list-group-item clearfix">
                                            <span class="logframe-numbers">{{ $assumption->numbering}}</span> <span
                                                    class="logframe-names">{{$assumption->assumption}}</span>

                                            <span class="del-btn">
                                        <a data-url="{{route("admin.projects.assumptions.edit",[$assumption->id,'parent_id' => $model->id, 'type' => $title])}}"
                                           data-toggle="modal"
                                           data-modal="crudModal"
                                           href='javascript:void(0)'
                                        >
                                            <i class="icon md-edit" aria-hidden="true"></i>
                                        </a>

                                                {!! Form::open(['url' => route('admin.projects.assumptions.destroy', ['id' => $assumption->id, 'params' =>['parent_id' => isset($model)?$model->id:0]]) , 'method' => 'DELETE']) !!}
                                                {!! Form::button( '<i class="icon md-delete" aria-hidden="true"></i>',
                                                    [
                                                        'type' => 'button',
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#confirmDelete',
                                                        'data-title' => 'Delete Row',
                                                        'data-message' =>  'Are you sure you want to delete?'
                                                    ])
                                                !!}
                                                {!! Form::close() !!}
                                        </span>

                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
                            <div class="add-btn text-center">
                                <a data-toggle="modal"
                                   data-modal="crudModal"
                                   data-title="Assumption"
                                   data-url="{{route("admin.projects.assumptions.create",['parent_id' => $model->id, 'type' => $title])}}"
                                   href="javascript:void(0)">Add More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection