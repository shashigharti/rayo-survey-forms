<div class="modal fade" id="researchToolModal">
    <div class="modal-dialog">
        @set('location_type', get_location_type_by_class($location->locationable_type))
        <form action="{{ route('website.realestate.market.survey', [ $location_type, $location->slug ]) }}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    Home Sales Activity
                </h4>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group row mr-t-10">
                        <div class="col s12">
                            <input type="radio" name="search_type" value="market-survey" checked/>
                            <label for="lead_type">Local Home Owners - View Recent Home Sales & Prices in your Neighborhood</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col s12">
                            <input type="radio" name="search_type" value="market-report"/>
                            <label for="lead_type">Home Buyers - Analyze Home Sales Patterns in
                                <span class="text-capitalize">{{ isset($model) && isset($page) ? $model->slug : ' the area.' }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span>
                    <button type="submit" class="btn btn-primary">
                        Explore the market
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>
