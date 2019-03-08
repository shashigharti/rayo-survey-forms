@set('table_id', isset($table_id)?$table_id:1)
<div class="left-menu" id="left_menu">
    <ul class="left left-change" id="theMenu">
        <a href="javascript:void(0)" class="left-menu-bar menu-open"><i class="fa arrow fa-chevron-left"></i></a>
        <div class="item-tooltip">
            <li class="item">
                <a href="javascript:void(0)"><i class="icon fa fa-home"></i></a>
                <span class="btn-class"><a class="menu_item"
                                           href="{{route('survey.data.dashboard')}}">{{trans('website.left-menu.dashboard')}}</a>
                </span>
            </li>
            <span class="tooltiptext tooltip-right">{{trans('website.left-menu.dashboard')}}</span>
        </div>
        <div class="item-tooltip">
            <li class="item">
                <a href="javascript:void(0)"><i class="icon fa fa-file-pdf-o"></i></a>
                <span class="btn-class"><a class="menu_item"
                                           href="{{route('profile.facts-sheet', [\Auth::user()->id])}}">{{trans('website.left-menu.factsheet')}}</a>
                </span>
            </li>
            <span class="tooltiptext tooltip-right">{{trans('website.left-menu.factsheet')}}</span>
        </div>
        <div class="item-tooltip">
            <li class="item">
                <a href="javascript:void(0)"><i class="icon fa fa-user"></i></a>
                <span class="btn-class">
                    <a class="menu_item" data-toggle="collapse" href="#profile-menu"
                       href="#">{{trans('website.left-menu.profile')}}</a>
                    <a class="toggle-sign" data-toggle="collapse" href="#profile-menu"><i class="fa fa-plus"></i></a>
                </span>
                <ul id="profile-menu" class="sub-menu collapse">
                    <div class="item-tooltip">
                        <li class="item">
                            <span class="btn-class">
                                    <a class="menu_item" href="{{route('profile.report', [\Auth::user()->id])}}"
                                       target="_blank">{{trans('website.left-menu.profile_report')}}
                                    </a>
                            </span>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item">
                            <span class="btn-class">
                                <a class="menu_item"
                                   href="{{ route('member.profile.detail') }} ">{{trans('website.left-menu.household_details')}}</a>
                            </span>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item">
                            <span class="btn-class">
                                <a class="menu_item" data-toggle="collapse" href="#panjikaran-menu"
                                   href="#">{{trans('website.left-menu.registration')}}</a>
                                <a class="toggle-sign" data-toggle="collapse" href="#panjikaran-menu"><i
                                            class="fa fa-plus"></i></a>
                            </span>
                            <ul id="panjikaran-menu" class="sub-menu sub-child-menu collapse">
                                <div class="item-tooltip">
                                    <li class="item">
                                        <span class="btn-class">
                                            <a class="menu_item"
                                               href="{{ route('marriage.search') }} ">{{trans('website.left-menu.marriage')}}</a>
                                        </span>
                                    </li>
                                    <li class="item">
                                        <span class="btn-class">
                                            <a class="menu_item"
                                               href="{{ route('divorce.search') }} ">{{trans('website.left-menu.divorce')}}</a>
                                        </span>
                                    </li>
                                    <li class="item">
                                        <span class="btn-class">
                                            <a class="menu_item"
                                               href="{{ route('death.search') }} ">{{trans('website.left-menu.death')}}</a>
                                        </span>
                                    </li>
                                    <li class="item">
                                        <span class="btn-class">
                                            <a class="menu_item"
                                               href="{{ route('migration.search') }} ">{{trans('website.left-menu.migration')}}</a>
                                        </span>
                                    </li>
                                    <li class="item">
                                        <span class="btn-class">
                                            <a class="menu_item"
                                               href="{{ route('birth.search') }} ">{{trans('website.left-menu.birth')}}</a>
                                        </span>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </div>
                </ul>
            </li>
            <span class="tooltiptext tooltip-right">{{trans('website.left-menu.profile')}}</span>
        </div>
        <div class="item-tooltip">
            <li class="item">
                <a href="javascript:void(0)"><i class="icon fa fa-database"></i></a>
                <span class="btn-class">
                    <a class="menu_item" data-toggle="collapse" href="#secondary-menu"
                       href="#">{{trans('website.left-menu.institutional_data')}}</a>
                    <a class="toggle-sign" data-toggle="collapse" href="#secondary-menu"><i class="fa fa-plus"></i></a>
                </span>
                <ul id="secondary-menu"
                    class="sub-menu collapse {{$survey_helper->isReportActive(\Request::url(), $table_id)?'in':''}}"
                    aria-expanded="{{$survey_helper->isReportActive(\Request::url(), $table_id)}}">
                    <li class="item">
                        <a class="menu_item" href="{{route('secondary.table',[1])}}">
                            <span class="btn-class">{{trans('website.left-menu.tabulation')}} </span>
                        </a>
                    </li>
                </ul>
            </li>
            <span class="tooltiptext tooltip-right">{{trans('website.left-menu.institutional_data')}}</span>
        </div>
        <div class="item-tooltip">
            <li class="item">
                <a href="javascript:void(0)"><i class="icon fa fa-file"></i></a>
                <span class="btn-class">
                    <a class="menu_item" data-toggle="collapse" href="#report-menu" href="#">{{trans('website.left-menu.report')}}</a>
                    <a class="toggle-sign" data-toggle="collapse" href="#report-menu"><i class="fa fa-plus"></i></a>
                </span>
                <ul id="report-menu" class="sub-menu collapse {{$survey_helper->isReportActive(\Request::url(), $table_id)?'in':''}}"
                                aria-expanded="{{$survey_helper->isReportActive(\Request::url(), $table_id)}}">
                    <li class="item {{ is_active(route('survey.data.report', 1)) }}">
                        <a class="menu_item" href="{{ route('survey.data.report', 1)  }}">
                            <span class="btn-class">{{trans('website.left-menu.tabulation')}}</span>
                        </a>
                    </li>
                    <li class="item {{ is_active(route('survey.data.filter.all')) }}">
                        <a class="menu_item" href="{{ route('survey.report.cross-tab')  }}">
                            <span class="btn-class">{{trans('website.left-menu.insights')}}</span>
                        </a>
                    </li>

                    @can('admin.report.custom')
                    <li class="item {{ is_active(route('survey.report.custom', [1])) }}">
                        <a class="menu_item" href="{{ route('survey.report.custom', [1])  }}">
                            <span class="btn-class">Custom</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <span class="tooltiptext tooltip-right">{{trans('website.left-menu.report')}}</span>
        </div>
        <div class="item-tooltip">
            <li class="item">
                <a href="javascript:void(0)"><i class="icon fa fa-globe" aria-hidden="true"></i></a>
                <span class="btn-class">
                    <a class="menu_item" data-toggle="collapse" href="#survey-menu"
                       href="#">{{trans('website.left-menu.survey')}}</a>
                    <a class="toggle-sign" data-toggle="collapse" href="#survey-menu"><i class="fa fa-plus"></i></a>
                </span>
                <ul id="survey-menu" class="sub-menu collapse">
                    <div class="item-tooltip">
                        <li class="item">
                            <span class="btn-class">
                                <a class="menu_item"
                                   href="{{route('survey.data.downloads.index')}}">{{trans('website.left-menu.downloads')}}</a>
                            </span>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item {{ is_active(route('survey.data.filter')) }}">
                            <a class="menu_item" href="{{ route('survey.data.filter', ['search_type' => 'data']) }}">
                                <span class="btn-class">{{trans('website.left-menu.all_data')}}</span>
                        </a>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item {{ is_active(route('survey.data.filter.all')) }}">
                            <a class="menu_item" href="{{ route('survey.data.filter.all', ['search_type' => 'all']) }}">
                                <span class="btn-class">{{trans('website.left-menu.data_by_surveyor')}}</span>
                            </a>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item {{ is_active(route('survey.data.filter.ward')) }}">
                            <a class="menu_item" href="{{ route('survey.data.filter.ward', ['search_type' => 'ward']) }}">
                                <span class="btn-class">{{trans('website.left-menu.data_by_wardno')}}</span>
                            </a>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item {{ is_active(route('survey.incomplete-data')) }}">
                            <a class="menu_item" href="{{ route('survey.incomplete-data') }}">
                                <span class="btn-class">{{trans('website.left-menu.incomplete_data')}}</span>
                            </a>
                        </li>
                    </div>
                    <div class="item-tooltip">
                        <li class="item {{ is_active(route('survey.data.filter.duplicate')) }}">
                            <a class="menu_item" href="{{ route('survey.data.filter.duplicate', ['search_type' => 'duplicate']) }}">
                                <span class="btn-class">{{trans('website.left-menu.duplicate_submissions')}}</span>
                            </a>
                        </li>
                    </div>
                </ul>
            </li>
            <span class="tooltiptext tooltip-right">{{trans('website.left-menu.search')}}</span>
        </div>
        @can('admin.survey.delete')
            <div class="item-tooltip">
                <li class="item">
                    <a href="javascript:void(0)"><i class="icon fa fa-trash"></i></a>
                    <span class="btn-class">
                        <a class="menu_item"
                           href="{{route("website.survey.get-bulk-delete")}}">{{trans('website.left-menu.bulk_delete')}}</a>
                    </span>
                </li>
                <span class="tooltiptext tooltip-right">{{trans('website.left-menu.bulk_delete')}}</span>
            </div>
        @endcan
    </ul>
</div>
