<div class="page-aside-switch">
    <i class="icon md-chevron-left" aria-hidden="true"></i>
    <i class="icon md-chevron-right" aria-hidden="true"></i>
</div>
<div class="page-aside-inner scrollable is-enabled scrollable-vertical" data-plugin="pageAsideScroll"
     style="position: relative;">
    <div data-role="container" class="scrollable-container" style="height: 691px; width: 270px;">
        <div data-role="content" class="scrollable-content" style="width: 259px;">
            <section class="page-aside-section">
                <h5 class="page-aside-title">Filter</h5>
                <div class="list-group">
                    <a class="list-group-item {{is_active(route('admin.medias.type', 'image'))}}" href="{{ route('admin.medias.type', 'image') }}"><i class="icon md-collection-image-o"
                                                                            aria-hidden="true"></i>Images</a>
                    <a class="list-group-item {{is_active(route('admin.medias.type', 'doc'))}}" href="{{ route('admin.medias.type', 'doc') }}"><i class="icon fa fa-file-word-o"
                                                                            aria-hidden="true"></i>Doc</a>
                    <a class="list-group-item {{is_active(route('admin.medias.type', 'pdf'))}}" href="{{ route('admin.medias.type', 'pdf') }}"><i class="icon md-collection-pdf"
                                                                            aria-hidden="true"></i>PDF</a>
                    <a class="list-group-item {{is_active(route('admin.medias.type', 'xls'))}}" href="{{ route('admin.medias.type', 'xls') }}"><i class="icon fa fa-file-excel-o"
                                                                            aria-hidden="true"></i>Xls</a>                                </div>
            </section>
        </div>
    </div>
    <div class="scrollable-bar scrollable-bar-vertical is-disabled scrollable-bar-hide"
         draggable="false">
        <div class="scrollable-bar-handle"></div>
    </div>
</div>