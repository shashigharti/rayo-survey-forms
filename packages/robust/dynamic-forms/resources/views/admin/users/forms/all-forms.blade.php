@extends('core::admin.layouts.default')
@section('content')

    <div class="page dashboard-content">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Title</th>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <td>
                        {{$d['id']}}
                    </td>
                    <td>
                        <a class="menu_item" href="{{route('admin.userform', $d['slug'])}}">{{$d['title']}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

