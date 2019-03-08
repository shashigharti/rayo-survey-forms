<div class="text-left col-sm-12 form-group margin-b-10">
    <a class="fill-survey" href="{{ route('website.survey.fill') }}" class="pull-right fill"><i class="fa fa-edit"></i>Fill
        Blank Survey
    </a>
    <a href="{{route(Route::currentRouteName(), $query_params + ['action' => 'export'])}}" class="pull-right export-btn fill-survey">
        <i class="fa fa-file-excel-o" aria-hidden="true"></i>Export
    </a>

    <div class="col-sm-5"><span>Total Records:</span> {{$total_records_found}}</div>
</div>