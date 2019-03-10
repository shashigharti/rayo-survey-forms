<ul class="nav nav-tabs navigation">
    @if(is_edit_mode($model))
        <li class="{{is_active(route('admin.report-designer.reports.edit',[$model->id]))}}">
            <a href="{{route('admin.report-designer.reports.edit',[$model->id])}}">Info</a>
        </li>
        <li class="{{is_active(route('admin.report-designer.design',[$model->id]))}}">
            <a href="{{route('admin.report-designer.design', [$model->id])}}">Design</a>
        </li>
    @endif
</ul>
