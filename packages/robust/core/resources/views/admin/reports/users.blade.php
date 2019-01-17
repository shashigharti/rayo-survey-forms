@extends('core::admin.layouts.sub-layouts.report')
@section('report_body')

    @set('user_helper', new Robust\Core\Helpers\Reports\UserHelper)
    @set('users', $user_helper->users()->all())

    <div class="table-responsive table-bordered">
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Name
                </th>
                <th>Email</th>
                <th>Username</th>

            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name.' '. $user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{ $user->user_name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection