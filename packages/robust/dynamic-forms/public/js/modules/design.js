;
(function ($, FRW, window, document, undefined) {
    'use strict';

    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.FormContainer = {

        startup: true,
        init: function (obj) {
            this.obj = $(".dynamic-form__designer");
            this.id = this.obj.data("id");

            $('body').on('click', '.dynamic-form__designer .dynamic-form__form-element', FRW.FormContainer.selectElement);
            $('body').on('click', '.dynamic-form__options-save', this.saveProperty);
            $('body').on('input', '.description-editor', this.saveProperty);
            //$('body').on('mouseover', '.dynamic-form__editor', this.showEditor);
            $('.dynamic-form__designer .dynamic-form__form-element').first().trigger('click');

            //Track Mouse hover for droppable div
            $('.dynamic-form__droppable')
                .mouseout(function () {
                    $(this).removeClass('ui-droppable-selected');
                })
                .mouseover(function (e) {
                    $(this).parents().removeClass('.ui-droppable-selected');
                    $(this).addClass('ui-droppable-selected');
                    e.stopPropagation();
                });

            $('body').on('click', '.dynamic-form__designer .dynamic-form__form-element', function (e) {
                $(this).find('.description-editor').toggleClass('hidden shown');
            }).find('.description-editor').on('click', function (e) {
                e.stopPropagation();
            });

            //Make elements sortable after its dropped in outer container
            $('.dynamic-form__droppable').sortable({
                containerSelector: '.dynamic-form__droppable',
                itemSelector: '.dynamic-form__form-element',
                connectWith: '.dynamic-form__droppable',
                handle: '.handle',
                onDrag: function ($item, position, _super, event) {
                    $item.css({top: 0, left: 0});
                    $('.dynamic-form__droppable').sortable('disable');
                    $('.ui-droppable-selected').sortable('enable');
                },
                onDrop: function ($item, container, _super) {
                    var $droppable = $('.dynamic-form__droppable');
                    $droppable.sortable('enable');
                    $('.placeholder').replaceWith($item);

                    var $orders = [], $ids = [],
                        url = $droppable.data('sort-url'),
                        page = $droppable.data('page');

                    $(".dynamic-form__designer .dynamic-form__form-element").each(function ($index, $el) {
                        $orders[$index] = $(this).data('order');
                        $ids[$index] = $(this).data('id');
                    });

                    $orders.sort(function (a, b) {
                        return a - b
                    });

                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {orders: $orders, fields: $ids, page: page}
                    });
                    _super($item, container);
                }
            }).droppable({
                tolerance: 'pointer',
                greedy: true,
                drop: this.onDrop,
                over: this.onOver,
                out: this.onOut
            });
        },
        onDrop: function (event, ui) {
            var type = ui.draggable.data('type'),
                url = ui.draggable.data('url'),
                $this = $(this),
                draggable = ui.draggable;

            var type_arr = type.split(",");
            if ($(this).hasClass('.dynamic-form__designer')) {
                var page_no = $(this).data('page-no');
            } else {
                var page_no = $(this).closest('.dynamic-form__designer').data('page-no');
            }
            for (var i = 0; i < type_arr.length; i++) {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {type: type_arr[i], name:'', page_no: page_no},
                    success: function ($result) {
                        $this.append($result.ui_view);
                        FRW.Editor.init();
                        $(".form-group").children().prop('disabled', true);
                        $this.last().trigger('click');

                    }
                });
            }
        },
        selectElement: function (e) {
            e.stopPropagation();
            $('.ui-selected').removeClass('ui-selected');
            $(this).addClass('ui-selected');
            var url = $(this).data('property-url');

            $.ajax({
                method: "GET",
                url: url,
                success: function ($result) {
                    $('.dynamic-form__property-box').remove();
                    $('.dynamic-form .left-box').append($result);
                    $('.dynamic-form .left-box .token-field').tokenfield();
                    $('.dynamic-form__property-box').trigger('property-loaded');
                }
            });

        },
        saveProperty: function (e) {
            tinyMCE.triggerSave();
            var form = $(this).closest("form");
            var form_data = form.serialize();
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: form.attr("action"),

                data: form_data,
                success: function ($result) {
                    $('.left-box').prepend($result.message);
                    $('.alert').fadeOut(3000, "linear");
                }
            });
        }
    }

    FRW.UIControlBoxElement = {
        init: function (obj) {
            this.obj = $(".dynamic-form__draggable li");
            this.id = this.obj.data("id");
            this.type = this.obj.data("type");
            this.title = this.type + "-" + this.id;
            this.properties = {};

            this.obj.draggable({
                helper: "clone",
                connectWith: '.dynamic-form__droppable',
                opacity: 0.5,
                zIndex: 10
            });
        }
    };

    FRW.UIPropertyBox = {

        init: function () {
            $('body').on('keyup', '.dynamic-form__property-box form :input', this.onKeyUp);
            $('body').on('change', '.dynamic-form__property-box form :input', this.onChange);
        },
        onChange: function () {
            var $property_box = $(this).closest('.dynamic-form__property-box');
            var $target = $property_box.data('target-type');
            switch ($target) {
                case 'checkbox':
                    FRW.CheckBox.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'text':
                    FRW.Text.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'radio':
                    FRW.Radio.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'textarea':
                    FRW.TextArea.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'select':
                    FRW.Select.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'multi-question':
                    FRW.MultipleQuestion.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'multi-input':
                    FRW.MultipleInput.onChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
            }
        },
        onKeyUp: function () {
            var $property_box = $(this).closest('.dynamic-form__property-box');
            var $target = $property_box.data('target-type');
            switch ($target) {
                case 'text':
                    FRW.Text.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'checkbox':
                    FRW.CheckBox.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'radio':
                    FRW.Radio.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'textarea':
                    FRW.TextArea.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'select':
                    FRW.Select.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'multi-question':
                    FRW.MultipleQuestion.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
                case 'multi-input':
                    FRW.MultipleInput.onPropertyChange($(this), $('.ui-selected'), $property_box, $(this).val());
                    break;
            }
        },
        onBlur: function () {
            var $property_box = $(this).closest('.dynamic-form__property-box');
            var $target = $property_box.data('target-type');
            switch ($target) {

            }
        }

    };
    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        FRW.UIControlBoxElement.init();
        FRW.FormContainer.init();
        FRW.UIPropertyBox.init();

        $('.forms__permissions input').on('change', function (event) {
            var $form = $('.forms__permissions');
            $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: $form.serialize()
            });
        });

        var check_public = $(".make-public").is(':checked');
        if (check_public) {
            $(".public-link").css("display", "inline");
        }
        else {
            $(".public-link").css("display", "none");

        }

        $(".make-public").click(function () {
            if ($(this).is(":checked")) {
                $(".public-link").css("display", "inline");

            } else {
                $(".public-link").css("display", "none");
            }
        });


        var check_user_email = $(".user_email_check").is(':checked');
        if (check_user_email) {
            $(".user_email_field").css("display", "block");
        }
        else {
            $(".user_email_field").css("display", "none");

        }

        $(".user_email_check").click(function () {
            if ($(this).is(":checked")) {
                $(".user_email_field").css("display", "block");

            } else {
                $(".user_email_field").css("display", "none");
            }
        });

        $('body').on('change', '.multiselect-predefined', function(){
            var $selected_data = $('.multiselect-predefined option:selected').val();
            $('.multi-select__options').tokenfield('setTokens', $selected_data);

        });




    });

}(jQuery, FRW, window, document));