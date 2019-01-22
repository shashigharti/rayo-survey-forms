<div class="projects-wrap">
    <ul class="blocks blocks-100 blocks-xlg-5 blocks-md-4 blocks-sm-3 blocks-xs-2"
        data-plugin="animateList" data-child="&gt;li">
        @foreach($records as $key => $record)
            <li>
                <div class="panel single-project">
                    <figure class="overlay overlay-hover animation-hover">
                        <img class="caption-figure"
                             src="{{ ($record->thumbnail) ? \Asset::images()->getImage($record->thumbnail, 'medium'): URL::asset('assets/images/pro.jpg') }}">
                        <figcaption
                                class="overlay-panel overlay-background overlay-fade text-center vertical-align">
                            <div class="btn-group btn-group-flat project__group-btn">
                                <div class="dropdown pull-left">
                                    <button type="button"
                                            class="btn btn-icon btn-pure btn-default dropdown-toggle waves-effect waves-classic"
                                            title="Setting"><i class="icon md-settings"
                                                               aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="">Copy</a></li>
                                        <li><a href="">Rename</a></li>
                                    </ul>
                                </div>


                                {!! Form::open(['url' => route('admin.projects.destroy', $record->id), 'method' => 'DELETE']) !!}
                                {!! Form::button( '<i class="icon md-delete"
                                                                                    aria-hidden="true"></i>',
                                    [
                                    'type' => 'button',
                                    'class'=> "btn btn-icon btn-pure btn-default waves-effect waves-classic",
                                    'data-toggle' => 'modal',
                                    'data-target' => '#confirmDelete',
                                    'data-title' => isset($option['data_title'])?$option['data_title']:'Delete Project
                                    y',
                                    'data-message' =>  isset($option['data_message'])?$option['data_message']:'Are you sure you want to delete?'
                                    ] ) !!}
                                {!! Form::close() !!}


                                {{--<button type="button"--}}
                                        {{--class="btn btn-icon btn-pure btn-default waves-effect waves-classic"--}}
                                        {{--title="Delete" data-tag="project-delete"><i class="icon md-delete"--}}
                                                                                    {{--aria-hidden="true"></i>--}}
                                {{--</button>--}}
                            </div>
                            <a href="{{$ui->getTableRoute($ui->columns['options']['edit'], [
                        'id' => $record->id,'params' => ['parent_id' => isset($model)?$model->id:0]])}}"
                               class="btn btn-inverse project-button waves-effect waves-light">View
                                Project
                            </a>
                        </figcaption>
                    </figure>
                    <div class="time pull-right">{{ ($record->created_at) ? $record->created_at->diffForHumans() : ''}}</div>
                    <div class="project-title"><a href="{{$ui->getTableRoute($ui->columns['options']['edit'], [
                        'id' => $record->id,'params' => ['parent_id' => isset($model)?$model->id:0]])}}">{{$record->name}}</a>
                    </div>
                    <div class="project-desc">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore e</p>
                    </div>
                    <div class="project-status">
                        <span>Project Status</span>
                        <button type="" class="btn-info">Developing</button>
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
</div>