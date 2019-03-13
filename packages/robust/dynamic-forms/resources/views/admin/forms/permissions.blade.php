@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)
    <form action="{{route('admin.user.form.permission')}}" method="POST">
        @csrf
        <div id="form_permission">
            <input type="hidden" name="base_url" value="{{url('/')}}">
            <input type="hidden" name="form_id" value="{{$form_id}}">
        </div>
        <div class="form-group">
            <label for="users">Users</label>
            <select class="form-control js-example-basic-multiple" id="users" name="users[]" multiple="multiple">

                @foreach($unpermitted_users as $user)
                    <option value="{{$user[0]}}">{{$user[1] . ' ' . $user[2]}}</option>
                @endforeach
                @foreach($permitted_users as $user)
                    <option value="{{$user['id']}}" selected>{{$user['first_name'] . ' ' . $user['last_name']}}</option>
                @endforeach


            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Permissions</button>
        </div>
    </form>

@endsection

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
