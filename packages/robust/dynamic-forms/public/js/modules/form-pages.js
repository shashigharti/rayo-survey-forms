;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DynamicForms = {};

    FRW.DynamicForms.FrontEndFormContainer = {
        gotoNextPage: function () {
            var current_fieldset = $(this).parents('fieldset');
            if (!FRW.DynamicForms.FrontEndFormContainer.isValid(current_fieldset)) {
                return;
            }

            current_fieldset.fadeOut(400, function () {
                var next_page = $(this).find("input[name='_next']").val();

                var next_page_obj = (next_page != "") ? $("[data-page='" + next_page + "']") : $(this).next();

                //Set Previous button of Next Page
                var btn_previous = next_page_obj.find("input[name='_previous']");
                btn_previous.val($(this).data("page"));

                //Display Next Page
                next_page_obj.fadeIn();
            });

        },

        gotoPreviousPage: function () {
            $(this).parents('fieldset').fadeOut(400, function () {
                var previous_page = $(this).find("input[name='_previous']").val();
                var previous_page_obj = (previous_page != "") ? $("[data-page='" + previous_page + "']") : $(this).prev();

                previous_page_obj.fadeIn();
            });
        },
        changeToSubmit: function (parent_fieldset) {
            parent_fieldset.find(".btn-next").html('Submit').prop("disabled", false);
            parent_fieldset.find(".btn-next").toggleClass('btn-next').toggleClass('btn-submit');
        },
        changeToNext: function (parent_fieldset) {
            parent_fieldset.find(".btn-submit").html('Next').prop("disabled", false);
            parent_fieldset.find(".btn-submit").toggleClass('btn-next').toggleClass('btn-submit');
        },
        isValid: function (fieldset) {
            var valid = true;
            fieldset.find(':input:not(:button, submit):visible').each(function (index, value) {
                var name = $(this).attr('name');
                if ($(this).is(":checkbox") && $(this).is(":invalid")) {
                    if ($("input[name='" + name + "']:checked").length <= 0) {
                        valid = false;
                    } else {
                        $(this).removeAttr('required');
                    }
                } else if ($(this).is(":invalid")) {
                    valid = false;
                }
                console.log($(this).is(":invalid"));
                if ($(this).is(":invalid")) {
                    $(this).parent(".control-required:not(.alert)")
                        .addClass('alert alert-danger')
                        .append('<div class=validation-message>*This field is Required.</div>');
                }
            });
            return valid;
        },
        onChange: function () {

            //FRW.DynamicForms.FrontEndFormContainer.saveFormData();
            if (($(this).parent(".control-required").hasClass('alert alert-danger'))) {

                $(this).parent(".control-required").toggleClass('alert alert-danger');
                $(this).parent('.control-required').find('.validation-message').remove();
            }
        },
        saveFormData: function () {
            var $form = $('.dynamic-progress-form').closest('form');
            var $remote_url = $form.attr('action');
            var $formData = $form.serialize();

            $.ajax({
                url: $remote_url,
                type: 'POST',
                data: $formData,
                cache: false,
                success: function ($result) {

                    if ($result.data_id > 0) {
                        $form.find("input[name='data_id']").val($result.data_id);
                    }

                    if ($result.completed == 1 && ($("input[name='is_submit_btn_clicked']").val() == 1)) {
                        $('.dynamic__form-container .alert-success').prepend($result.success).fadeOut("slow");
                        location.reload(true);
                    }

                }
            });

            return false;
        }

    }
    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        $('.dynamic__form-container fieldset').hide().eq(0).fadeIn('slow');
        $('.btn-next').on('click', FRW.DynamicForms.FrontEndFormContainer.gotoNextPage);
        $('.btn-previous').on('click', FRW.DynamicForms.FrontEndFormContainer.gotoPreviousPage);
        $("[data-condition='condition-check']").on('change', FRW.DynamicForms.FrontEndFormContainer.applyCondition);
        $('.dynamic-progress-form :input:not(:button, submit):visible').on('change', FRW.DynamicForms.FrontEndFormContainer.onChange);

        $(document).on('click', '.btn-submit', function () {
            //$this.closest("form:input[name='status_completed']").val(1);
            //$(this).prop("disabled", true);
            $(this).html('<i class="fa fa-spinner fa-spin"></i>Loading');
        });

        //Disable  Default Validation Error Message
        document.querySelector("form")
            .addEventListener("invalid", function (event) {
                event.preventDefault();
            }, true);

        $("[data-condition='condition-check']:checked").trigger('change');
    });


}(jQuery, FRW, window, document));