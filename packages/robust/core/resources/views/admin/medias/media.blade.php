@extends('core::admin.layouts.sub-layouts.blank')
<!-- @section('custom_title')
    <div class="page-title">

        <span class="create-btn">
            {{ Form::open(['route' => 'admin.medias.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            <div class="pull-right">
                <div class="site-action upload-button_div">
                    <a href="#" class="site-action-toggle media-upload_button">
                        <i aria-hidden="true" class="icon md-plus"></i>
                        <span>Media</span>
                    </a>

                    <input type="file" id="fileupload" name="media[]" multiple="true">
                </div>
            </div>
            {{ Form::close() }}
        </span>
    </div>
@endsection -->

@section('custom_design')
    <div class="media">
        <!-- <div class="panel-body bg-white">
            <!-- Media Sidebar -->
            <div class="page-aside">
                @include('core::admin.partials.medias.left')
            </div>
            <!-- Media Content -->
            <div class="page-main">
                @include('core::admin.partials.medias.search')
                        <!-- Media Content -->
                <div class="page-content-table" data-selectable="selectable">
                    <!-- Actions -->
                    <div class="page-content-actions">
                        <div class="actions-inner">
                            <div class="checkbox-custom checkbox-theme checkbox-lg">
                                <input id="media_all" class="selectable-all" type="checkbox">
                                <label for="media_all"> <b>Select All</b></label>
                            </div>
                        </div>
                    </div>
                    <!-- Media -->
                    <div class="media-list is-grid padding-bottom-50">
                        <ul class="blocks">
                            @foreach($records as $record)
                                <li class="animation-scale-up col-lg-2 col-md-2 col-sm-6" data-path="">
                                    <div class="media-item">
                                        @include('core::admin.partials.medias.tools-dropdown')
                                        <div class="checkbox-custom checkbox-theme checkbox-lg">
                                            <input class="selectable-item" id="media_1" type="checkbox">
                                            <label for="media_1"></label>
                                        </div>
                                        <div class="image-wrap">
                                            <img class="image img-rounded"
                                                 src="{{ ($record->type == 'image') ? \Asset::images()->getImage($record->id, 'medium'): asset('assets/images/'.$record->type.'.png') }}"
                                                 alt="...">
                                        </div>

                                        <div class="info-wrap">
                                            <div class="title">{{ $record->name }}</div>
                                            <div class="time">{{ $record->created_at->diffForHumans() }}</div>
                                            @include('core::admin.partials.medias.tools-btn')
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {!! $records->links() !!}
                </div>
            </div>
        </div> -->
    </div>
@endsection
