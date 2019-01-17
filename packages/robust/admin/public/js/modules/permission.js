;
(function ($, FRW, window, document, undefined) {
    'use strict';

    $(document).ready(function () {
        $(".select_groups").change(function () {
            var field_to_check = $(this).data('group');
            if (this.checked) {
                $("." + field_to_check + "").each(function () {
                    this.checked = true;
                })
            } else {
                $("." + field_to_check + "").each(function () {
                    this.checked = false;
                })
            }
            var isAllGroupSelected = 1;
            $('.select_groups').each(function () {
                if (!this.checked)
                    isAllGroupSelected = 0;
            });

            if (isAllGroupSelected == 1) {
                $('.select_all').prop("checked", true);
            }
            else {
                $('.select_all').prop("checked", false);
            }
        });
        $(".each_permission").click(function () {
            var field_to_uncheck = $(this).data('parent');
            if ($(this).is(":checked")) {
                var isAllIndividualChecked = 0;
                $("." + field_to_uncheck + "").each(function () {
                    if (!this.checked)
                        isAllIndividualChecked = 1;
                })
                if (isAllIndividualChecked == 0) {
                    $("#" + field_to_uncheck + "").prop("checked", true);

                }
            }
            else {
                $("#" + field_to_uncheck + "").prop("checked", false);
                $('.select_all').prop("checked", false);
            }

            var isAllChecked = 1;
            $('.each_permission').each(function () {
                if (!this.checked)
                    isAllChecked = 0;
            });

            if (isAllChecked == 1) {
                $('.select_all').prop("checked", true);

            }
        });

        $(".select_all").change(function () {
            if (this.checked) {
                $(".permissions").each(function () {
                    this.checked = true;
                })
            } else {
                $(".permissions").each(function () {
                    this.checked = false;
                })
            }
        });


        var isAllEachChecked = 1;
        $(".each_permission").each(function () {
            if (!this.checked)
                isAllEachChecked = 0;
        })
        if (isAllEachChecked == 1) {
            $(".select_all").prop("checked", true);
        }
        else {
            $(".select_all").prop("checked", false);

        }

        $('.select_groups').each(function () {
            var child = $(this).data('group');
            var isAllChildSelected = 1;
            $('.' + child + '').each(function () {
                if (!this.checked)
                    isAllChildSelected = 0;
            });

            if (isAllChildSelected == 1)
                this.checked = true;
            else
                this.checked = false;
        });
    });

}(jQuery, FRW, window, document));

