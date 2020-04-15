<div class="user-favourite">
    <h3 class="title-more-detail favourite-title">My Favourites Properties (0)</h3>
    <div class="sort-filter">
        <div class="left-align col s8">
            <a
                class="user-favourite__btns compare-favourite btn btn-theme modal-trigger"
                href="#compare-favourite"
            >
                Compare Checkmarked Properties
            </a>
            <div id="compare-favourite" class="compare-favourite__table modal">
                <div class="modal-content">
                    <table>
                        <thead>
                        <tr>
                            <th>Property Name</th>
                            <th>System Price</th>
                            <th>Asking Price</th>
                            <th>Sold Price</th>
                            <th>Bedrooms</th>
                            <th>Bathrooms</th>
                            <th>Days on MLS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($lead->favourites) && !empty($lead->favourites))
                            @foreach($lead->favourites as $key => $listing)
                                <tr data-id="{{ $listing->id . "-" .$listing->slug }}" class="hide">
                                    <td>
                                        {{ $listing->name }}
                                    </td>
                                    <td>
                                        {{ $listing->system_price }}
                                    </td>
                                    <td>
                                        {{ $listing->asking_price }}
                                    </td>
                                    <td>
                                        {{ $listing->sold_price }}
                                    </td>
                                    <td>
                                        {{ $listing->bedrooms }}
                                    </td>
                                    <td>
                                        {{ $listing->baths_full }}
                                    </td>
                                    <td>
                                        {{ $listing->days_on_mls }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                </div>
            </div>
            <a
                class="user-favourite__btns show-on-map btn btn-green"
                data-base-url="{{ route('website.realestate.leads.map') }}"
            >
                Show On Map
            </a>
        </div>
        <div class="right-align">
            <div class="sort-favourite">
                Sort By-
                <button class="btn btn-xs btn-default">$High-Low</button>
                <button class="btn btn-xs btn-default">$Low-High</button>
            </div>
        </div>
    </div>
    <div class="user-favourite__table col s12 mr-t-20">
        <table class="striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Property Type</th>
                <th>Asking Price</th>
            </tr>
            </thead>

            <tbody>
            @if(isset($lead->favourites) && !empty($lead->favourites))
                @foreach($lead->favourites as $key => $listing)
                    <tr>
                        <td>
                            <label>
                                {{ Form::checkbox("listings[]", $listing->id . "-" .$listing->slug) }}
                                <span>{{ $listing->name }}</span>
                            </label>
                        </td>
                        <td>{{ $listing->class }}</td>
                        <td>{{ $listing->system_price }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
