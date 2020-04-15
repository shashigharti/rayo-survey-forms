@extends(Site::templateResolver('core::website.layouts.default'))
@section('header')
    <div class="banner">
        <div class="slider">
            @include(Site::templateResolver('core::website.banners.main-banner'))
            @include(Site::templateResolver('core::website.layouts.partials.mobile-menu'))
            <div class="banner-overlay">
                <div class="container-fluid">
                    <div class="row">
                        <div class="site-menu">
                            @include(Site::templateResolver('core::website.layouts.partials.menu'))
                        </div>
                    </div>
                    @include(Site::templateResolver('core::website.layouts.partials.search'))
                </div>
            </div>
        </div>
    </div>
    @include(Site::templateResolver('core::website.advance-search.index'))
@endsection
@section('body_section')
    @include(Site::templateResolver('core::website.layouts.partials.ad-banners'))
@endsection
@section('footer')
    @include(Site::templateResolver('core::website.layouts.partials.footer'))
@endsection
