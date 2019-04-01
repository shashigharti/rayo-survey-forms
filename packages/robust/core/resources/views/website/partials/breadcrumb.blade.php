@section('core.partials.breadcrumb')
    <ol class="breadcrumb">
        @section('core.partials.breadcrumbs.home')
            <li>
                <a href="{{ route('admin.user.dashboards.index') }}">
                    @section('core.partials.breadcrumbs.home.icon')
                        <i class="fa fa-home"></i>
                    @show
                    Home
                </a>
            </li>
        @show

        @section('core.partials.breadcrumbs.crumbs')
            @foreach ($crumbs as $crumb)
                    @if ($crumb['has_link'])
                        @if ($crumb['is_url'])
                            <li><a href="{{ $crumb['is_url'] }}">{{ $crumb['name'] }}</a></li>
                        @else
                            <li>{{ link_to_route($crumb['route'], $crumb['name'], $crumb['parameters']) }}</li>
                        @endif
                    @else
                    <li class="active">{{ $crumb['name'] }}</li>
                @endif
            @endforeach
        @show
    </ol>
@show
