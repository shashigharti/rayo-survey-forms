@if ($pages)
    <ul class="nav nav-tabs page-nav">

        @foreach(range(1, $pages) as $key => $page)
            <li class="{{(session('current_page')) ? (session('current_page') == $key + 1 ) ? 'active' : '' : ($key == 0 && !session('altered')) ?'active':(session('altered') && $key == sizeof(range(1,$pages))-1) ? 'active' :''}}">
                <a data-toggle="tab" href="#page-{{$page}}">
                    <span>    Page {{$page}}</span>

                </a>
                <span>
                    {{ Form::open(array('route' => ['admin.forms.pages.destroy', $form->id, $page], 'method' => 'DELETE', 'class' => 'form-inline')) }}

                    {{ Form::button('&times;',['type' => 'submit', 'class' => 'close',
                        'data-action' => 'delete',
                        'aria-label' =>"Close",
                        'data-confirm-message' => 'Are you sure you want to delete this?' ])
                    }}

                    {{ Form::close() }}</span>
            </li>
        @endforeach
        <li>
            {{Form::open(['route' => ['admin.forms.pages.store', $form->id], 'method' => 'PUT', 'target' => '_blank'])}}
            <button type="submit"
                    class="btn btn-sm btn-close btn-icon btn-primary waves-effect waves-light waves-round"
                    data-toggle="tooltip" data-original-title="Edit">
                <i class="icon md-plus" aria-hidden="true"></i>
            </button>
            {{Form::close()}}
        </li>
            <li>
                {{Form::open(['route' => ['admin.forms.print', $form->id], 'method' => 'GET'])}}
                <button type="submit"
                        class="btn btn-sm btn-close btn-icon btn-primary waves-effect waves-light waves-round"
                        data-toggle="tooltip" data-original-title="Edit">
                    <i class="icon md-print" aria-hidden="true"></i>
                </button>
                {{Form::close()}}
            </li>
    </ul>
@endif