;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.MultipleInput = {
        data: {questions: '', targets: ''},
        init: function () {
            $(document).on('click', ".multiple-input__sub-questions .btn", function () {
                $(this).parent('li').remove();
                FRW.MultipleInput.setQuestion();
            });
            $(document).on('property-loaded', '.dynamic-form__property-box', function () {
                FRW.MultipleInput.data.questions = $(this).find('.multiple-input__sub-questions').data('questions');
                FRW.MultipleInput.data.targets = $(this).find('.multiple-input__sub-questions').data('targets');
                $('.multiple-input__sub-questions').trigger('changed');
            });

            $(document).on('changed', ".multiple-input__sub-questions", function () {
                FRW.MultipleInput.resetTable($('.ui-selected'));
            });
        },
        setQuestion: function () {
            FRW.MultipleInput.data.questions = $('.multiple-input__sub-questions input[name="properties[questions][]"]').map(function () {
                return this.value;
            }).get().join();
            FRW.MultipleInput.data.targets = $('.multiple-input__sub-questions input[name="properties[targets][]"]').map(function () {
                return this.value;
            }).get().join();
            $('.multiple-input__sub-questions').trigger('changed');
        },
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            if ($elem.attr('name') == 'label') {
                $dest.find('label').html(value);
            }
        },
        onChange: function ($elem, $dest, frm_property_box, value) {
            var $target = $elem.attr('name');
            $("<li />", {
                class: "list-group-item",
                html: '<input name="properties[targets][]" placeholder="Target" type="text" value=""> ' + '<input name="properties[questions][]" type="text" value="' + value + '"> ' +
                '<button type="button" class="btn btn-icon btn-pure btn-default waves-effect waves-classic"><i class="icon md-delete" aria-hidden="true"></i></button>'
            }).appendTo(".multiple-input ul");
            this.setQuestion();
        },
        resetTable: function (elem) {
            var $elem_to_update = elem.find('.multiple-input__sub-questions');
            $elem_to_update.empty();

            if (FRW.MultipleInput.data.questions !== undefined) {
                var $header = $("<tr />", {
                    html: '<th> Questions </th><th>Value</th>'
                }).appendTo($elem_to_update);
                var $questions = (FRW.MultipleInput.data.questions != 'undefined') ? FRW.MultipleInput.data.questions.split(',') : '';
                var $targets = (FRW.MultipleInput.data.targets != 'undefined') ? FRW.MultipleInput.data.targets.split(',') : '';

                $.each($questions, function (index, value) {
                    var $target = ($targets[index] == '')?'': '(Target:' + $targets[index] + ')'
                    var $tr = $("<tr />", {
                        html: '<td>' + value + $target +'</td><td>' + "<input type='text' name=" + elem.data("name") + ">" + '</td>'
                    }).appendTo($elem_to_update);
                });
            }
        }
    }

    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        FRW.MultipleInput.init();
    });

}(jQuery, FRW, window, document));