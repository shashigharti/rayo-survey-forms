@set('menus', settings('real-estate', 'menus') != ""? settings('real-estate', 'menus') : [])
<div class="container-fluid">
    <div class="row">
        <div class="col m4 s12">
            <h3>Contact details</h3>
            {!!  settings('app-setting', 'footer_content')  !!}
        </div>
        <div class="col m4 s12">
            <h3>Useful Links</h3>
            @set('menus', $banner_helper->getBannersBySlug('useful-links'))
            @if($menus)
                @set('properties', json_decode($menus->properties))
                @set('titles', $properties->titles)
                @set('urls', $properties->urls)
                @foreach($titles as $key => $title)
                    <a href="{{ $urls[$key] }}">
                        <p>{{ $title }}</p>
                    </a>
                @endforeach
            @endif
        </div>
        <div class="col m4 s12">
            <h3>Info & Services</h3>
            @set('menus', $banner_helper->getBannersBySlug('info-services'))
            @if($menus)
                @set('properties', json_decode($menus->properties))
                @set('titles', $properties->titles)
                @set('urls', $properties->urls)
                @foreach($titles as $key => $title)
                    <a href="{{ $urls[$key] }}">
                        <p>{{ $title }}</p>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="footer-bottom container-fluid">
    <div class="row">
        <div class="col s12 center-align">
            <p>{!!  settings('app-setting', 'copyright_text')  !!}</p>
        </div>
    </div>
</div>
