<div class="dropdown">
    <span class="icon md-settings dropdown-toggle" role="button" data-toggle="dropdown"
          data-animation="scale-up"></span>


    {!! Form::open(['url' => route('admin.medias.destroy', $record->id), 'method' => 'DELETE']) !!}

    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <li><a href="{{ asset('uploads/'.$record->id.'/'.$record->file) }}" download><i class="icon md-download"
                                                                                        aria-hidden="true"></i>Download</a>
        </li>
        <li><a data-toggle="modal"
               data-modal="crudModal"
               data-title={{ $title }}
                       data-url="{{ route('admin.medias.edit', $record->id) }}"
               href="javascript:void(0)"
            ><i class="icon md-edit" aria-hidden="true"></i>Edit Detail</a></li>
        <li><a href="javascript:void(0)" data-toggle="modal" data-title="Delete Media"
               data-message="Are you sure you want to delete?" data-target="#confirmDelete"><i class="icon md-delete"
                                                                                               aria-hidden="true"></i>Delete</a>
        </li>
    </ul>
    {!! Form::close() !!}

</div>