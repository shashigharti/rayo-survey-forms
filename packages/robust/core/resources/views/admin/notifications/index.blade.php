@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
@set('notifications', $user->notifications()->get())
<div class="row">
    <div class="col-xs-6">Your Notifications</div>
    <div class="col-xs-6">Notification Settings</div>
</div>
<hr>

<div class="row">
    <div class="col-xs-6">
        <ul class="list-unstyled">
            @foreach($notifications as $notification)
                <li>
                    {{$notification->data['title']}}
                </li>
            @endforeach
        </ul></div>
    <div class="col-xs-6">
        @foreach($notifications as $notification)
            @if($notification->read_at!=null)
                <a href="">Show Notification</a>

                @else
                <a href="">Hide Notification</a>
                @endif
        @endforeach
    </div>
@endsection