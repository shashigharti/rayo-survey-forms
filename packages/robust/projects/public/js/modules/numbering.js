;
(function ($, FRW, window, document, undefined) {
    'use strict';

    //PLEASE DONT REMOVE ANY COMMENTS

    $(document).ready(function ($) {

        $('#crudModal').on('modal-loaded', function () {

            var $count_url = $(this).data('numbering-url');
            if ($count_url) {
                $.ajax({
                    url: $count_url
                }).done(function (data) {
                    $("#numbering").val(data.max);
                });
            }
            $('#logframe-parent-field').trigger('change');
            $('#indicator-parent-field').trigger('change');
            $('#logframe-super-parent-field').trigger('change');

        });
        $(document).on('change', '#target-group-filter', function () {
            var $filter_url = $(this).data('filter-url');
            var $parent_type = $('#indicator-parent-field option:selected').val();
            //var $parent_type = $('.selected_filters').val();

            var $target_id = $('#target-group-filter option:selected').val();

            if ($target_id == 0) {
                $('#indicator-parent-field').trigger('change');
            } else {
                var $selected = $("#indicator_filter-table-data").data('selected');
                var $selected_arr = $selected.split(',');

                $.ajax({
                    url: $filter_url,
                    data: {'parent_type': $parent_type, 'target_id': $target_id},
                    success: function (result) {
                        $('#indicator_filter-table-data').html('');
                        result.forEach(function ($key) {
                            var $select_stat = '';
                            if ($.inArray(($key.id).toString(), $selected_arr) != -1)
                                $select_stat = 'checked';
                            $('<tr> <td> <input class="checkbox_selectable" type="checkbox" ' + $select_stat + ' name="indicator_ids[]" value=' + $key.id + '></td><td>' + $key.numbering + '</td> <td>' + $key.name + '</td> <td>' + $key.indicatable_type_name + '</td><td><input type="text"></td> <td><input type="text"></td> <td>' + $key.type + '</td></tr>').appendTo($('#indicator_filter-table tbody:last-child'));
                        });
                    }
                });
            }


        });

        $(document).on('change', '#indicator-parent-field', function (event, param) {
            var $parent_id = $('#indicator-parent-field option:selected').val();
            var $count_url = $(this).data('numbering-url');
            var $parent_url = $(this).data('parent-url');
            var $parent_type = $(this).data('parent-type');
            var $super_parent_url = $(this).data('super-parent-url');

            $("#target-group-filter").val("0");

            if ($count_url) {
                $.ajax({
                    url: $count_url,
                    data: {'parent_id': $parent_id, 'parent_type': $parent_type}
                }).done(function (data) {
                    $("#numbering").val(data.max);
                });
            }

            if ($parent_url) {
                $.ajax({
                    url: $parent_url,
                    data: {'parent_id': $parent_id, 'parent_type': $parent_type},
                    success: function (result) {
                        $('#logframe-parent-field').html('');
                        $('<option value="0"> Select Parent Indicator </option>').appendTo($('#logframe-parent-field'));

                        result.forEach(function ($key) {
                            $('<option value=' + $key.id + '>' + $key.numbering + '  ' + $key.name + '</option>').appendTo($('#logframe-parent-field'));
                        });
                    }
                });
            }

            if ($super_parent_url) {
                //
                //var $selected_filters = $('.selected_filters').val().split(',');
                //if (param != 'true') {
                //    if ($.inArray($parent_id, $selected_filters) == -1) {
                //        $selected_filters.push($parent_id);
                //        $('.selected-filters_badge').append('<span class="badge badge-pill badge-default">' + $parent_id + '<i class="fa fa-times selected_filters_remove" data-filter="' + $parent_id + '"></i> </span>');
                //        $('.selected_filters').val(String($selected_filters));
                //    }
                //}
                var $selected = $("#indicator_filter-table-data").data('selected');
                var $selected_arr = $selected.split(',');
                var $filter = $(this).data('filter');
                $.ajax({
                    url: $super_parent_url,
                    data: {
                        'filter': $filter,
                        'super_parent_type': $parent_id
                    },
                    success: function (result) {
                        $('#indicator_filter-table-data').html('');
                        result.forEach(function ($key) {
                            var $select_stat = '';
                            if ($.inArray(($key.id).toString(), $selected_arr) != -1)
                                $select_stat = 'checked';
                            $('<tr> <td> <input class="checkbox_selectable" type="checkbox" ' + $select_stat + ' name="indicator_ids[]" value=' + $key.id + '></td> <td>' + $key.numbering + '</td><td>' + $key.name + '</td> <td>' + $key.indicatable_type_name + '</td><td><input type="text"></td> <td><input type="text"></td> <td>' + $key.type + '</td></tr>').appendTo($('#indicator_filter-table tbody:last-child'));
                        });
                    }
                });
            }
        });

        //TODO
        //NEW CHANGES
        $(document).on('click', '.selected_filters_remove', function () {
            var $filter = $(this).data('filter');
            var $selected_filters = $('.selected_filters').val().split(',');

            if ($.inArray($filter, $selected_filters) != -1) {
                $selected_filters.splice($selected_filters.indexOf($filter), 1);
                $(this).closest('span').remove();
                $('.selected_filters').val(String($selected_filters));
            }

            $('#indicator-parent-field').trigger('change', ['true']);
        });
        //UPTO HERE
        //TODO UPTO HERE


        $(document).on('change', '#logframe-parent-field', function () {
            var $parent_id = $('#logframe-parent-field option:selected').val();
            var $parent_url = $(this).data('numbering-url');
            if ($parent_id != 0) {
                $.ajax({
                    url: $parent_url,
                    data: {'own_parent_id': $parent_id}
                }).done(function (data) {
                    $("#numbering").val(data.max);
                });
            }
        });

        $(document).on('change', '#logframe-super-parent-field', function () {
            var $parent_id = $('#logframe-super-parent-field option:selected').val();
            var $super_parent_url = $(this).data('numbering-url');
            var $parent_type = $(this).data('parent-type');
            var $parent_url = $(this).data('parent-url');

            if ($parent_id != 0) {
                $.ajax({
                    url: $super_parent_url,
                    data: {'super_parent_id': $parent_id, 'parent_type': $parent_type}
                }).done(function (data) {
                    $("#numbering").val(data.max);
                });
            }


            $.ajax({
                url: $parent_url,
                data: {'parent_id': $parent_id, 'parent_type': $parent_type},
                success: function (result) {
                    $('#logframe-parent-field').html('');
                    $('<option value="0"> Select Parent</option>').appendTo($('#logframe-parent-field'));

                    result.forEach(function ($key) {
                        $('<option value=' + $key.id + '>' + $key.numbering + '  ' + $key.name + '</option>').appendTo($('#logframe-parent-field'));
                    });
                }
            });
        });
    });


}(jQuery, FRW, window, document));