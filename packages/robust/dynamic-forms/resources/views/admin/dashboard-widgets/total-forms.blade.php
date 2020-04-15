@set('widget_helper',new Robust\DynamicForms\Helpers\WidgetHelper)
<div class="col-lg-3 col-sm-6 widget-container">
    <div class="widget widget-shadow" id="widgetLineareaOne">
        <div class="widget-content">
            <div class="padding-20 padding-top-10">
                <div class="clearfix">
                    <span class="del-btn">
                        <i class="icon md-delete handle" aria-hidden="true"></i>
                   </span>
                    <span class="drag-btn">
                        <i class="fa fa-arrows handle"></i>
                    </span>
                    <div class="grey-800 pull-left padding-vertical-10">
                        <i class="icon md-account grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>
                        Total Forms
                    </div>
                    <span class="pull-right grey-700 font-size-30 widget__widget-count"><a href="{{route('admin.dynamic-forms.index')}}">{{$widget_helper->getForms()->count()}}</a></span>
                </div>
                <div class="margin-bottom-20 grey-500 widget__widget-percentage-up">
                    <i class="icon md-long-arrow-up green-500 font-size-16"></i>
                    2% This Week
                </div>
                <div class="ct-chart height-50"></div>
            </div>
        </div>
    </div>
</div>