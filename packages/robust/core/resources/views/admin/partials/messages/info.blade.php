@if (isset($message))
    <div class="alert alert-success" role="alert" style="margin-top:10px">
        {{$message}}
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success" role="alert" >
        {!! session('message') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert" >
        {!! session('error') !!}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif