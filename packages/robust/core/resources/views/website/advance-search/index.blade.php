@set('blocks', settings('advance-search'))
@set('search_settings',settings('real-estate'))
@set('default_values',$blocks['default_values'] ?? [])
@if(!empty($blocks))
    <div id='adv-search-dropdown'>
        <form id="frm-search" method="get" action="{{ $advancesearch_helper->getSearchURL() }}" >
            <div class="inner">
                <a href="" class="advance-search advance-search_close"><i class="material-icons">clear</i></a>
                <div class="row">
                    @set('adSearchConfig', config('rws.advance-search'))
                    @if(isset($blocks['first_block']))
                        @include(Site::templateResolver('core::website.advance-search.first-block'),['blocks' => $blocks['first_block']])
                    @endif
                    @if(isset($blocks['second_block']))
                        @include(Site::templateResolver('core::website.advance-search.second-block'),['blocks' => $blocks['second_block']])
                    @endif
                    @if(isset($blocks['third_block']))
                        @include(Site::templateResolver('core::website.advance-search.third-block'),['blocks' => $blocks['third_block']])
                    @endif
                    @if(isset($blocks['fourth_block']))
                        @include(Site::templateResolver('core::website.advance-search.fourth-block'),['blocks' => $blocks['fourth_block']])
                    @endif
                </div>
                <div class="row">
                    <div class="col s3 mb-20 right">
                        @if(auth()->check())
                            <button href="#" data-search-save-url="" class="theme-btn advance-search__save">Save
                            </button>
                        @endif
                        <button href="#" class="theme-btn" type="submit">search</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="sort_by" value="{{ $query_params['sort_by'] ?? ''}}">
        </form>
    </div>
@endif
