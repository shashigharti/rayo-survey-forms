<div class="row designer__tools">
    @if(View::exists("reports::admin.reports.design.partials.tool-box.{$type}"))
        @include("reports::admin.reports.design.partials.tool-box.{$type}")
    @endif

    <button type="button" data-action="del-el" class="btn btn-default btn-round btn-trash"><i class="fa fa-trash"></i></button>
</div>