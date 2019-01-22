;
(function ($, FRW, window, document, undefined) {
    'use strict';

    FRW.TokenField = {
        init: function () {
            $('.token-field').each(function () {
                if ($(this).attr('data-src-url')) {
                    let url = $(this).data('src-url');
                    let $id = 'id';
                    let $name = 'name';

                    if (this.hasAttribute("data-id")) {
                        $id = $(this).data('id');
                    }
                    if (this.hasAttribute("data-id")) {
                        $name = $(this).data('name');
                    }


                    let $value = $(this).data('value');
                    var data = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        remote: {
                            url: url,
                            filter: function (response) {
                                var $response = response;

                                if(response.hasOwnProperty('data')){
                                    $response = response.data
                                }

                                return $.map($response, function (data) {
                                    return {
                                        value: data[$id],
                                        label: data[$name]
                                    };
                                });
                            }
                        }
                    });
                    $(this).tokenfield({
                        typeahead: [null, {
                            display: 'label',
                            limit: 17,
                            source: data
                        }]
                    });

                }
                else {
                    $(this).tokenfield();
                }

                $(this).on('tokenfield:createtoken', function (event) {
                    var existingTokens = $(this).tokenfield('getTokens');
                    $.each(existingTokens, function (index, token) {
                        if (token.value === event.attrs.value)
                            event.preventDefault();
                    });
                });
            });
        }
    };

    $(document).ready(function ($) {
        FRW.TokenField.init();
    });
}(jQuery, FRW, window, document));
