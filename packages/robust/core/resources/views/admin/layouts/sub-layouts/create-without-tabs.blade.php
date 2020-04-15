@extends('core::admin.layouts.default')

@section('content')
    <div id="main" class="page {{$title}}">
        <div class="row">
            <div class="container">
                <div class="row breadcrumbs-inline" id="breadcrumbs-wrapper">
                    {!! Breadcrumb::getInstance()->render()  !!}
                </div>
            </div>
        </div>
        <div class="row">
             <div class="container">
                 <div class="row">
                     <div class="col s12">
                         {{ $title }}
                     </div>
                     <div class="col s12">
                         @yield('form')
                     </div>
                 </div>
             </div>
        </div>
    </div>
@endsection

