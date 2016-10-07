var Game = {

    board_size : 3,
    player : 'X',
    player_img: {
        'O' : 'circle',
        'X' : 'cross'
    },

    //change to the api address (create a config file to add this?)
    api_url : '',

    play : function() {

        // var params = {
        //   player_unit: this.player
        // };
        //
        // var response = this.api_request("PUT", api_url + 'game', params);

        response = '';
        this.display_board(response);
    },

    bind_events : function () {
        $('.mark-position').click(function(e) {
            e.preventDefault();
            this.make_move(
                $(this).data('line'),
                $(this).data('column'),
                this.player
            );
        });
    },

    api_request : function (request_type, url_method, data) {

        var response = {};

        $.ajax({
            type: request_type,
            url: this.api_url + url_method,
            data: data,
            statusCode: {
                // 404: function() {
                //     return false;
                // }
            }
        }).done(function(result) {
            response = $.parseJSON(result);
        });

        return response;
    },


    display_board : function (api_response) {

        var images = [];
        images['X'] = '<img alt="Cross" src="img/cross.png" />';
        images['O'] = '<img alt="Circle" src="img/circle.png" />';

        var board = "<table>" +
            "<tr>" +
                "<td>" + images['X'] + "</td>" +
                "<td>" + images['O'] + "</td>" +
                "<td><a class=\"mark-position\" data-line=\"0\" data-column=\"2\" href=\"#\">&nbsp;</a></td>" +
            "</tr>" +
            "<tr>" +
                "<td><a class=\"mark-position\" data-line=\"1\" data-column=\"0\" href=\"#\">&nbsp;</a></td>" +
                "<td><a class=\"mark-position\" data-line=\"1\" data-column=\"1\" href=\"#\">&nbsp;</a></td>" +
                "<td><a class=\"mark-position\" data-line=\"1\" data-column=\"2\" href=\"#\">&nbsp;</a></td>" +
            "</tr>" +
            "<tr>" +
                "<td><a class=\"mark-position\" data-line=\"2\" data-column=\"0\" href=\"#\">&nbsp;</a></td>" +
                "<td><a class=\"mark-position\" data-line=\"2\" data-column=\"1\" href=\"#\">&nbsp;</a></td>" +
                "<td><a class=\"mark-position\" data-line=\"2\" data-column=\"2\" href=\"#\">&nbsp;</a></td>" +
            "</tr>" +
        "</table>";

        $('.board').html("").html(board);
    },

    make_move : function (line, column) {

        line = parseInt(line);
        column = parseInt(column);

        if (line < 0 && line >= board_size) {
            return false;
        }

        if (column < 0 && column >= board_size) {
            return false;
        }

        debugger;

        var params = {
            line: line,
            column: column
        //     ,player_unit: this.player
        };

        var result = this.api_request(
            "POST",
            api_url + 'game/move/' + this.player,
            params
        );

    }
};


$(document).ready(function() {
    Game.bind_events();
    Game.play();
});
