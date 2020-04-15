@extends(Site::templateResolver('core::website.layouts.default'))
@inject('banner_helper','Robust\RealEstate\Helpers\BannerHelper')
@inject('location_helper','Robust\RealEstate\Helpers\LocationHelper')
@set('locations', $location_helper->getLocations(['cities','counties','zips']))
@section('header')
    <header class="sub-header">
        <div class="container-fluid">
            <div class="site-menu">
                @include(Site::templateResolver('core::website.layouts.partials.menu'))
            </div>
        </div>
    </header>
@endsection
@section('body_section')
    <section class="main-content">
            <div class="row">
                <div class="side-tab">
                    @include(Site::templateResolver('core::website.user-profile.partials.side-nav'))
                </div>
                <div class="side-tab-content">
                    <div class="profile--tab col s12">
                        <div id="profile" class="col s12">
                            @include(Site::templateResolver('core::website.user-profile.partials.info'))
                        </div>
                        <div id="favourites" class="col s12">
                            @include(Site::templateResolver('core::website.user-profile.partials.favourites'))
                        </div>
                        <div id="reports" class="col s12">
                            @include(Site::templateResolver('core::website.user-profile.partials.reports'))
                        </div>
                        <div id="bookmarks" class="col s12">
                            @include(Site::templateResolver('core::website.user-profile.partials.bookmarks'))
                        </div>
                        <div id="searches" class="col s12">
                            @include(Site::templateResolver('core::website.user-profile.partials.searches'))
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('footer')
    @include(Site::templateResolver('core::website.layouts.partials.footer'))
@endsection
