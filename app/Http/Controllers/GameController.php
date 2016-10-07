<?php

namespace App\Http\Controllers;

use App\Game;
use App\BotPlayer;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function get_board(Request $request)
    {
        $game = new Game();

//        $request->session()->put('board_state', $game->board->state);

        $response = array (
            'board' => $game->board->state,
        );

        return response()->json($response);
    }

    public function make_move(Request $request)
    {

        $line        = $request->input('line');
        $column      = $request->input('column');
        $player_unit = strtoupper($request->input('player_unit'));

        $game = new Game();
        $game->makeMove($line, $column, $player_unit);

        // Todo: check if there is, at least, 3 turns to check has finished
        $result = $game->hasFinished();

        if ($result['has_finished'] == 'no') {
            $bot      = new BotPlayer();
            $position = $bot->makeMove($game->board, 'O');
            $game->makeMove($position[0], $position[1], 'O');
            $result   = $game->hasFinished();
        }

        $result['board'] = $game->board->state;
        return response()->json($result);

    }

    public function delete()
    {
        $game = new Game();
        $game->board->delete();

        $result['success'] = true;

        return response()->json($result);

    }
}
