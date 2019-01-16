;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.MultipleQuestion = {
        data: {headers: '', questions: '', targets:''},
        init: function () {
            $(document).on('click', ".multiple-questions__sub-questions .btn", function () {
                $(this).parent('li').remove();
                FRW.MultipleQuestion.setQuestion();
            });
            $(document).on('property-loaded', '.dynamic-form__property-box', function () {
                FRW.MultipleQuestion.data.questions = $(this).find('.multiple-questions__sub-questions').data('questions');
                FRW.MultipleQuestion.data.headers = $(this).find('.multiple-questions__sub-questions').data('headers');
                FRW.MultipleQuestion.data.targets = $(this).find('.multiple-questions__sub-questions').data('targets');
                $('.multiple-questions__sub-questions').trigger('changed');
            });

            $(document).on('changed', ".multiple-questions__sub-questions", function () {
                FRW.MultipleQuestion.resetTable($('.ui-selected'));
            });


        },
        setHeader: function () {
            FRW.MultipleQuestion.data.headers = $('.dynamic-form__property-box input[name="properties[options]"]').val();
            $('.multiple-questions__sub-questions').trigger('changed');
        },
        setQuestion: function () {
            FRW.MultipleQuestion.data.questions = $('.multiple-questions__sub-questions input[name="properties[questions][]"]').map(function () {
                return this.value;
            }).get().join();
            FRW.MultipleQuestion.data.targets = $('.multiple-questions__sub-questions input[name="properties[targets][]"]').map(function () {
                return this.value;
            }).get().join();
            $('.multiple-questions__sub-questions').trigger('changed');
        },
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            if ($elem.attr('name') == 'label') {
                $dest.find('label').html(value);
            }
        },
        onChange: function ($elem, $dest, frm_property_box, value) {
            var $target = $elem.attr('name');
            switch ($target) {
                case 'properties[questions]':
                    $("<li />", {
                        class: "list-group-item",
                        html: '<input name="properties[targets][]" placeholder="Target" type="text" value=""> ' + '<input name="properties[questions][]" type="text" value="' + value + '"> ' +
                        '<button type="button" class="btn btn-icon btn-pure btn-default waves-effect waves-classic"><i class="icon md-delete" aria-hidden="true"></i></button>'
                    }).appendTo(".multiple-questions ul");
                    this.setQuestion();
                    break;
                case 'properties[options]':
                    this.setHeader();
                    break;
            }
        },
        resetTable: function (elem) {
            var $elem_to_update = elem.find('.multiple-questions__sub-questions');
            $elem_to_update.empty();

            var $header = $("<tr />", {
                html: '<th> Questions </th>'
            }).appendTo($elem_to_update);

            if(FRW.MultipleQuestion.data.headers !== undefined){
                var $headers = FRW.MultipleQuestion.data.headers.split(',');
                $.each($headers, function (index, value) {
                    $("<th />", {
                        html: value
                    }).appendTo($header);
                });

                if(FRW.MultipleQuestion.data.questions !== undefined){
                    var $questions = FRW.MultipleQuestion.data.questions.split(',');
                    var $targets = FRW.MultipleQuestion.data.targets.split(',');
                    $.each($questions, function (index, value) {
                        var $target = ($targets[index] == '')?'': '(Target:' + $targets[index] + ')';
                        var $tr = $("<tr />", {
                            html: '<td>' + value + $target + '</td>'
                        }).appendTo($elem_to_update);

                        $.each($headers, function (ind, val) {
                            $("<td />", {
                                html: "<input type='radio' name=" + elem.data("name") + ">"
                            }).appendTo($tr);
                        });
                    });
                }
            }
        }
    }

    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        FRW.MultipleQuestion.init();
    });

}(jQuery, FRW, window, document));