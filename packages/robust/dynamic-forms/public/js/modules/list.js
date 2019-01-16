(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {

        $('.list-group-item').click(function () {
            $(this).parent().children('ul.list-group-item-submenu').toggle("show");
            $(this).find('.md-plus,.md-minus').toggleClass('.md-plus,.md-minus');
        });
        $('.list-group-item').parent().children('ul.list-group-item-submenu').toggle("show");

        $('.dynamic-form__list-search .list-group,.dynamic-form__list-search .list-group-item-submenu').searchable({
            selector: '.row',
            childSelector: '.name',
            searchField: '.search',
            striped: true,
            searchType: 'fuzzy'
        });


    });
}(jQuery, FRW, window, document));

