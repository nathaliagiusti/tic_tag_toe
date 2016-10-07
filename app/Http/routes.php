<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'GameController@index');

// API
$app->get('game', 'GameController@get_board');
$app->put('game', 'GameController@get_board');
$app->post('game', 'GameController@make_move');
$app->delete('game', 'GameController@delete');
