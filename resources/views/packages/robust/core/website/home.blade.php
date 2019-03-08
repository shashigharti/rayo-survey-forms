{{--@if(!\Auth::check())--}}
{{--<script type="text/javascript">--}}
{{--window.location = "{{ url('/user-login') }}";//here double curly bracket--}}
{{--</script>--}}
{{--@endif--}}
{{--@inject('role_helper', 'App\Helpers\RoleHelper')--}}
{{--@inject('survey_helper', 'App\Helpers\SurveyHelper')--}}

@extends(Site::templateResolver('packages.robust.core.website.partials.layouts.default'))
@section('content')
    @include(Site::templateResolver('core::website.partials.common.sub-header'))
    @include(Site::templateResolver('core::website.partials.dashboard.main-content'))
    @include(Site::templateResolver('core::website.partials.dashboard.footer'))
@endsection


