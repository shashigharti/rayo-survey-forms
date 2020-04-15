@set('settings', settings('advance-search'))
<div class="col s3">
    @foreach(sort_array_by_array($blocks, explode(',', $settings['fourth_block_order']) ?? []) as $block)
        @if(isset($adSearchConfig[$block]))
            @include(Site::templateResolver('core::website.advance-search.partials.'.$adSearchConfig[$block]['blade']),
            [
                'attribute' => $block,
                'display_name' => $adSearchConfig[$block]['display_name']
            ])
        @else
            @include(Site::templateResolver('core::website.advance-search.partials.'.$block))
        @endif
    @endforeach
</div>

