@extends(Site::templateResolver('core::website.layouts.default'))
@section('content')
    @if(\Auth::check())


        <div class="container dashboard-container">
            @include(Site::templateResolver('core::website.partials.common.header'))
            <div class="menu-dashboard">
                @include(Site::templateResolver('core::website.partials.common.left-menu'))
            </div>
            <div class="page dashboard-content">
            </div>
            @include(Site::templateResolver('core::website.partials.common.footer'))
        </div>
    @else
        @include(Site::templateResolver('core::website.partials.common.sub-header'))
        @include(Site::templateResolver('core::website.partials.dashboard.main-content'))
        @include(Site::templateResolver('core::website.partials.dashboard.footer'))
    @endif
@endsection


