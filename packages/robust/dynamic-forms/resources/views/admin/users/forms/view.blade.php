@extends('core::admin.layouts.default')
@section('content')

    <div class="page dashboard-content">
        <form id="dynamicForm">
            @csrf
            <div id="form__show">

            </div>
        </form>
    </div>
@endsection

