<?php
Route::group(['as' => 'website.','group' => 'Sitemap'], function () {
     Route::get('/sitemap.xml', [
        'as' => 'sitemaps.index',
        'uses' => 'Robust\Core\Controllers\Website\SitemapController@index',
    ]);
});
