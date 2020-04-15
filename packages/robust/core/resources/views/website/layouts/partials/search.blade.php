@set('mainBanner', $banner_helper->getBannersByType(['main-banner']))
@set('properties',count($mainBanner) > 0 ? json_decode($mainBanner[array_rand($mainBanner,1)]->properties) : null)
<div class="banner-caption">
   <h1>{{ ($properties != null) ? $properties->header : 'Find Your Dream House With Us' }}</h1>
   <div id="search-section" class="search-section">
      <div class="row">
         <div class="col s3">
            <p>Location</p>
            <input type="text" name="search" placeholder="Type a city,zip,address or MLS#">
         </div>
         <div class="col s6">
            <div class="row">
               <div class="col s4 range-bar">
                  <p>PRICE</p>
               <input class="price-range-slider jrange-slider" data-step="25000" data-format="$%s" data-min="25000" data-max="1000000" name="price" data-scale-min="25000" data-scale-max="1m+" type="hidden" value="{{ ($query_params['price_min'] ?? 0) . ',' . ($query_params['price_max'] ?? 1000000) }}" />
               </div>
               <div class="col s4 range-bar">
                  <p>BEDROOMS</p>
               <input class="bedroom-range-slider jrange-slider" data-min="1" data-max="5" data-scale-min="1" data-scale-max="5+" name="beds" type="hidden" value="{{ ($query_params['beds_min'] ?? 1) . ',' . ( $query_params['beds_max'] ?? 5) }}" />
               </div>
               <div class="col s4 range-bar">
                  <p>BATHROOMS</p>
                  <input class="bathroom-range-slider jrange-slider" data-min="1" data-max="5" data-scale-min="1" data-scale-max="5+" name="bathrooms" type="hidden" value="{{ ($query_params['bathrooms_min'] ?? 1) . ',' . ( $query_params['bathrooms_max'] ?? 5) }}" />
               </div>
            </div>
         </div>
         <div class="col s3 center-align">
            <div class="left">
               <p>FEATURES</p>
               <a href="#" class="theme-btn advance-search" data-search-save-url="">Advanced search</a>
            </div>
            <div class="right">
               <p>19723 HOMES FOR SALE</p>
               <button id="search-btn" class="theme-btn">Search</button>
            </div>
         </div>
      </div>
   </div>
</div>
