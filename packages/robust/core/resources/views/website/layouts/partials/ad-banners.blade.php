@set('singleColBlocks', $banner_helper->getBannersByType(['single-col-block']))
@set('bannerSortOrderArr', settings('front-page', 'single_col_banner_order'))

@if($bannerSortOrderArr !== '')
    @set('singleColBlocks', $banner_helper->sortBannersByArray($singleColBlocks, explode(",", $bannerSortOrderArr)))
@endif

<section class="search-lists">
    <div class="container-fluid">
        <div class="row">
            @set('col', settings('real-estate','banner_per_row') ? 12/settings('real-estate','banner_per_row') : 4)
            @foreach($singleColBlocks as $singleColBlock)
                @set('properties',json_decode($singleColBlock->properties, true))
                @include(Site::templateResolver("core::website.banners.single-col-block"))
            @endforeach
        </div>
    </div>
</section>
@include(Site::templateResolver("core::website.banners.two-col-ad"))
@include(Site::templateResolver("core::website.banners.full-screen-ad"))
