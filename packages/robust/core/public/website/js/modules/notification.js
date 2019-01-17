;
(function ($, FRW, window, document, undefined) {
    'use strict';

    FRW.Notification = {
        init: function () {
            var socket_url = $('.site-socket_url').val();
            if (socket_url) {
                var socket = io(socket_url);
                var url = $('.website-notification').data('notification-url');
                socket.on("notification-channel", function (message) {
                    var not_count = parseInt($('.website-notification_count').text());
                    if (!$.isNumeric(not_count)) {
                        $('.website-notification_count').text(1);
                    }
                    else
                        $('.website-notification_count').empty().text(not_count + 1);
                    FRW.Notification.populateNotifications();
                });
            }
        },

        populateNotifications: function () {
            var url = $('.website-notification').data('notification-url');
            // $('.website-notification').removeAttr('data-notification-url');

            $.ajax({
                url: url,
                success: function (res) {
                    $('.website-notification_list').empty();

                    if (res.length) {
                        res.forEach(function (each_notification) {
                            var notification_class = (each_notification.read_at == null) ? 'unread_notification' : '';
                            $('.website-notification_list').append('<a href="' + each_notification.data.route + '" class="' + notification_class + '">' + each_notification.data.title + '</a>')
                        });
                    } else {
                        $('.website-notification_list').append('<a href="#">No Notifications!</a>')
                    }
                }
            });
        },

        markAsRead: function () {
            var url = '/api/user/notifications/mark-as-read';
            $.ajax({
                url: url,
                method: 'POST',
                success: function (res) {
                    $('.website-notification_count').empty();
                }
            });
        }
    };

    $(document).ready(function ($) {
        FRW.Notification.init();
        if ($(".website-notification")[0])
            FRW.Notification.populateNotifications();
        $(document).on('click', '.website-notification', FRW.Notification.markAsRead)
    });
}(jQuery, FRW, window, document));
