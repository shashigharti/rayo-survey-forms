@set('data_type', (preg_match("/^column/", $type) > 0)?'column':$type)

<div class="row {{($data_type == 'column')?'report__section':'report__elem'}}" data-type="{{$data_type}}" data-property-url="{{route('admin.designer.propertybox',$data_type)}}" >
    @include("reports::admin.reports.design.partials.right-toolbox")
    @include("reports::admin.reports.design.elements.$type")
</div>
