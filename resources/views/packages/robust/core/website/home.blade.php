{{--@if(!\Auth::check())--}}
{{--<script type="text/javascript">--}}
{{--window.location = "{{ url('/user-login') }}";//here double curly bracket--}}
{{--</script>--}}
{{--@endif--}}
{{--@inject('role_helper', 'App\Helpers\RoleHelper')--}}
{{--@inject('survey_helper', 'App\Helpers\SurveyHelper')--}}

@extends(Site::templateResolver('core::website.layouts.default'))
@section('content')
    @if(\Auth::check())
        {{--@set('role', $role_helper->getRole())--}}
        {{--@set('total_records_found', $survey_helper->getUsersSurveryData($role))--}}

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


