<?php

namespace App;

/**
 * Class BotPlayer
 */
// In the way the interface is built, I cannot see how I can implement it,
//  except for the bot player class
// Todo: review this class
class BotPlayer implements MoveInterface {

    // it should be choose the movement
    public function makeMove(Board $board, $playerUnit = 'X')
    {
        $position = array();

        $available_positions = $board->getAvailablePositions();

        if ($available_positions) {
            $total_positions = count($available_positions);
            $key_pos         = rand(0, $total_positions);
            $position        = $available_positions[$key_pos];
        }

        return $position;
    }
}