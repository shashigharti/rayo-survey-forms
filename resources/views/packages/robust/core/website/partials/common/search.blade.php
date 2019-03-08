@if(is_active(route('survey.data.filter')))
    {{ Form::open(['url' => route('survey.data.filter'), 'method' => 'GET']) }}
    {{ Form::hidden('search_type', 'data')}}
@elseif(is_active(route('survey.data.filter.all')))
    {{ Form::open(['url' => route('survey.data.filter.all'), 'method' => 'GET']) }}
    {{ Form::hidden('search_type', 'all')}}
@elseif(is_active(route('survey.incomplete-data')))
    {{ Form::open(['url' => route('survey.incomplete-data'), 'method' => 'GET']) }}
@elseif(is_active(route('survey.data.filter.ward')))
    {{ Form::open(['url' => route('survey.data.filter.ward'), 'method' => 'GET']) }}
    {{ Form::hidden('search_type', 'ward')}}
@elseif(is_active(route('survey.data.filter.duplicate')))
    {{ Form::open(['url' => route('survey.data.filter.duplicate'), 'method' => 'GET']) }}
    {{ Form::hidden('search_type', 'duplicate')}}
@endif
@include(Site::templateResolver('core::website.partials.common.export-menu'))
<div class="col-sm-12 form-group row">
    @if(is_active(route('survey.incomplete-data')))
        <div class="col-sm-3">
            <label for="">Incomplete Data Type</label>
            {{ Form::select('type',
                [
                    'ward_no' => 'Ward No',
                    'family_details' => 'Family Details',
                    'house_no' => 'House No',
                    'geocode' => 'Geocode',
                    'house' => 'House Details'
                ],
                null, ['class' => 'form-control'])
            }}
        </div>
    @endif
    @can("admin.survey.view-all-data")

        <div class="col-sm-3 introduction-pradesh_lists">
            <label for="">प्रदेश नं.</label>
            {!! Form::select('pradesh_no', [
                'प्रदेश छान्नुहोस ',
                '1' => 'प्रदेश नं. १',
                '2' => 'प्रदेश नं. २',
                '3' => 'प्रदेश नं. ३',
                '4' => 'प्रदेश नं. ४',
                '5' => 'प्रदेश नं. ५',
                '6' => 'प्रदेश नं. ६',
                '7' => 'प्रदेश नं. ७'
            ], null, ['class' => 'form-control introduction-pradesh_selector']) !!}
        </div>

        <div class="col-sm-3 introduction-district_lists hidden">
            <label for="" class="introduction-district_lists-label"></label>
            {!! Form::select('district', [], null, ['class' => 'form-control introduction-district_selector', 'data-selected' => (isset($params) && isset($params['district'])) ? $params['district']:'0']) !!}
        </div>
        <div class="col-sm-3 introduction-local-government_lists hidden">
            <label for="" class="introduction-local-government_lists-label"></label>
            {!! Form::select('local_government', [], null, ['class' => 'form-control introduction-local-government_selector', 'disabled' => 'disabled', 'data-selected' => (isset($params) && isset($params['local_government'])) ? $params['local_government']:'0']) !!}
        </div>
    @endcan
</div>

<div class="col-sm-12 form-group row date--section">
    @if(!is_active(route('survey.data.filter.ward')))
        <div class="col-sm-3 surveyor-name">
            <label for="surveyor_name">Surveyor Name/Answerer Name</label>
            {{Form::text('surveyor_name')}}
        </div>
        <div class="col-sm-2 ward-no">
            <label for="ward_no">Ward No</label><br>
            {{Form::text('ward_no')}}
        </div>
        <div class="col-sm-2 ward-no">
            <label for="tole_name">Tole</label><br>
            {{Form::text('tole_name')}}
        </div>
    @endif
        <div class="col-sm-2 start-date">
            <label for="start-date">Start Date</label>
            {{Form::date('start-date', null)}}
        </div>
        <div class="col-sm-2 end-date">
            <label for="end-date">End Date</label>
            {{Form::date('end-date', null)}}
        </div>
</div>

<div class="form-group col-sm-12">
    <div class="pull-left end-date data-check">
        {{Form::checkbox('all')}}All Data
    </div>
    <div class="col-sm-2">
        {{ Form::submit('Filter', ['class' => 'theme-btn']) }}
    </div>
</div>

{{ Form::close() }}
<div class="col-sm-12">   
    <div class="search__records col-sm-6 text-left">
        @if(isset($surveys) && method_exists($surveys, 'total'))
            {{$surveys->count() }} of {{$surveys->total() }} Records
        @endif
    </div>
    <div class="pagination-bottom col-sm-6 text-right">
        @if(isset($params))
            {{ $surveys->appends($params) }}
        @else
            {{ $surveys->links() }}
        @endif
    </div>
</div>