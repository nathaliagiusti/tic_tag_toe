var Game = {

    board_size : 3,
    player : 'X',
    player_img: {
        'O' : 'circle',
        'X' : 'cross'
    },

    //change to the api address (create a config file to add this?)
    api_url : 'game',

    play : function() {

        var params = {
          player_unit: this.player
        };

        $.when(this.api_request("PUT", this.api_url, params)).done(function(response) {
            if (response.board) {
                Game.display_board(response.board);
            }
        });

    },

    bind_events : function () {
        $('.mark-position').on("click", function(e) {
            e.preventDefault();
            Game.make_move(
                $(this).data('line'),
                $(this).data('column')
            );
        });
    },

    api_request : function (request_type, api_url, data) {

        var response = [];
        var dfd = $.Deferred();

        $.ajax({
            type: request_type,
            url: api_url,
            data: data,
            statusCode: {
                // 404: function() {
                //     return false;
                // }
            }
        }).done(function(result) {
            response = result;
            dfd.resolve(response);
        });

        return dfd.promise();

    },


    display_board : function (api_response) {

        var images = [];
        images['X'] = '<img alt="Cross" src="img/cross.png" />';
        images['O'] = '<img alt="Circle" src="img/circle.png" />';

        var board = '<table>';

        api_response.forEach(function(line,row_pos){

            board += '<tr>';

                line.forEach(function(cell,cell_pos){
                    board += "<td>";

                    if (cell) {
                        board += images[cell];
                    } else {
                        board += '<a class="mark-position" data-line="'
                            + row_pos + '" data-column="' + cell_pos + '" href="#">&nbsp;' +
                            '</a>';
                    }

                    board += "</td>";
                });

            board += '</tr>';

        });

        board += '</table>';

        $('.board').html("").html(board);

        Game.bind_events();
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

        var params = {
            line: line,
            column: column,
            player_unit: this.player
        };

        $.when(this.api_request("POST", this.api_url,params)).done(function(response) {
            if (response.board) {
                Game.display_board(response.board);
            }

            if (response.has_finished == 'yes') {
                if (Game.player == response.winner_player) {
                    alert('Congrants! You won!');
                } else if (response.winner_player == 'Draw') {
                    alert('Draw!');
                } else {
                    alert('Sorry, You lost!');
                }
                Game.restart_game();
            }
        });

    },

    restart_game : function () {
        $.when(this.api_request("DELETE", this.api_url,{})).done(function(response) {
            if (response.success) {
                Game.play();
            }
        });
    }
};


$(document).ready(function() {
    Game.play();
});
