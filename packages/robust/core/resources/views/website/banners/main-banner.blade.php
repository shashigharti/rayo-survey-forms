@set('mainBannerSliders', $banner_helper->getBannersByType(['main-banner']))
<div class="slides owl-carousel owl-theme" id="banner--slider">
    @foreach($mainBannerSliders as $mainBannerSlider)
        @set('properties', json_decode($mainBannerSlider->properties))
        @if($properties)
            <div class="item">
                <img src="{{isset($properties->image) ? getMedia($properties->image) : "/images/banners/banner.jpg"}}" alt="banner">
            </div>
        @endif
    @endforeach
</div>
