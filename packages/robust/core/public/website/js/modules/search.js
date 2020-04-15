;
"use strict"
// Global function for Search 
class Search {
    constructor() {
        this._container = $('.search-filter');
        this._qParams = {};
        let thisObj = this;

        $('.search-filter').on('change', function (e) {
            let prop = $(this).attr('name');
            prop = prop.replace(/[\[\]']+/g, '');
            if (!thisObj._qParams[prop]) {
                thisObj._qParams[prop] = 0;
            }
            thisObj._qParams[prop] = $(this).val();
        });
    }
    getParams() {
        return this._qParams;
    }

    getQueryString() {
        return $.param(this._qParams);
    }

    setParamsFromQueryString() {

        let queries, url;
        url = window.location.search.substring(1);

        // Split into key/value pairs
        queries = url.split("&");

        // Convert the array of strings into an object
        $.each(queries, function (index, value) {
            let params = decodeURIComponent(value).split('='), isArray;
            let key = params[0].replace(/[\[\]']+/g, '');
            let param_value = params[1];
            isArray = /[\[\]']+/g.test(params[0]);

            if (param_value != '') {
                // For single value form params
                if (!isArray) {
                    this._qParams[key] = param_value;
                } else {
                    if (!this._qParams[key]) {
                        this._qParams[key] = [];
                    }
                    this._qParams[key].push(param_value);
                }
            }

        });
    }
}