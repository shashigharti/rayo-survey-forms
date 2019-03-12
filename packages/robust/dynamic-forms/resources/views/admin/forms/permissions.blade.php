@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)
    <form action="#" method="GET">
    <div id="form_permission">
        <input type="hidden" name="base_url" value="{{url('/')}}">
        {{--<fieldset>--}}
            {{--<legend>Roles:</legend>--}}
            {{--<select class="form-control js-example-basic-multiple" name="states[]" multiple="multiple">--}}
                {{--<option value="AL">Alabama</option>--}}
                {{--<option value="WY">Wyoming</option>--}}
            {{--</select>--}}
        {{--</fieldset>--}}
    </div>
    <div class="form-group">
        <label for="users">Users</label>
        <select class="form-control js-example-basic-multiple" id="users" name="users[]" multiple="multiple">
            @foreach($all_users as $user)
                <option value="{{$user->id}}">{{$user->first_name . ' ' . $user->last_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save Permissions</button>
    </div>
    </form>

@endsection

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
