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
        <div class="row user-favourite-map map-view container-fluid">
            <a
                class="user-favourite-map__btns btn btn-theme"
                href="{{ route('website.user.profile') }}"
            >
                << Back
            </a>
            @include('core::website.user-profile.partials.favourites.map')
        </div>
    </section>
@endsection
@section('footer')
    @include(Site::templateResolver('core::website.layouts.partials.footer'))
@endsection
