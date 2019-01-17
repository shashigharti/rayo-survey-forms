@if (is_array($services))
    <ul class="social_services col-xs-12 col-sm-4 list-unstyled list-inline {{ isset($class) ? $class : '' }}">
        @foreach ($services as $service)
            <li class="social__item">
                @include(Site::templateResolver('core::website.social.services.'.$service))
            </li>
        @endforeach
    </ul>
@endif