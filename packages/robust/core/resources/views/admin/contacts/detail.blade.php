@extends('core::admin.layouts.sub-layouts.view')

@section('sub-content')

    <tr>
        <td><b>Name</b></td>
        <td>{{ $contact->name }}</td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td>{{ $contact->email }}</td>
    </tr>

    <tr>
        <td><b>Phone No.</b></td>
        <td>{{ $contact->phone }}</td>
    </tr>

    <tr>
        <td><b>Subject</b></td>
        <td>{{ $contact->subject}}</td>
    </tr>
    <tr>
        <td><b>Message</b></td>
        <td>{{ $contact->message }}</td>
    </tr>

@endsection

@section('after-table')

        {{ Form::open(['route' => ['admin.reply.contacts', $contact->id],  'method' => 'POST']) }}

            <div class="form-group">
                <label for=""><b>Reply</b></label>
                {{ Form::textarea('message', null, ['class' => 'editor form-control']) }}
            </div>
            {{Form::submit('Reply',['class'=>'btn theme-btn'])}}
        {{ Form::close() }}

@stop