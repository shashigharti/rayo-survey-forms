(function ($, window, document, undefined) {
    'use strict';
    var app = require('express')();
    var server = require('http').Server(app);
    var io = require('socket.io')(server);
    var redis = require('redis');

    server.listen(8890);
    io.on('connection', function (socket) {
        console.log("new client connected");
        var redisClient = redis.createClient();
        redisClient.subscribe('private-form-submitted');

        redisClient.on("message", function (channel, message) {
            console.log("new message in queue " + message + "channel");
            socket.emit(channel, message);
        });

        socket.on('disconnect', function () {
            redisClient.quit();
        });

    });
})();

