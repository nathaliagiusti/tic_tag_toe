<?php

namespace App;

/**
 * Class Game
 */
class Game {

    public $board;
    private $playerUnits = ['X','O'];


    public function __construct()
    {
        $this->board = new Board;
    }

    public function isValidPlayer($playerUnit)
    {
        return in_array($playerUnit, $this->playerUnits);
    }

    /**
     * @param string $line
     * @param string column
     * @param string $playerUnit X | O
     * @return mixed
     */
    public function makeMove($line, $column, $playerUnit)
    {
        if ($this->isValidPlayer($playerUnit)) {
            $this->board->markMove($line, $column, $playerUnit);
        } else {
            // Todo : implement error
            return false;
        }

    }

    public function hasWinnerDiagonal()
    {
        $board = $this->board->state;

        // diagonal
        if ($board[0][0] && $board[0][0] == $board[1][1])  {
            if ($board[1][1] == $board[2][2]) {
                return $board[2][2];
            }
        }

        return false;

    }

    public function hasWinnerAntiDiagonal()
    {
        $board = $this->board->state;

        if ($board[0][2] && $board[0][2] == $board[1][1]) {
            if ($board[1][1] == $board[2][0]) {
                return $board[2][0];
            }
        }

        return false;

    }

    public function hasWinnerHorizontalOrVertical()
    {
        $board_size = count($this->board->state);
        $board      = $this->board->state;

        for ($i=0; $i < $board_size; $i++) {

            //horizontal
            if ($board[$i][0] && $board[$i][0] == $board[$i][1]) {
                if ($board[$i][1] == $board[$i][2]) {
                    return $board[$i][2];
                }
            }

            //vertical
            if ($board[0][$i] && $board[0][$i] == $board[1][$i]) {
                if ($board[1][$i] == $board[2][$i]) {
                    return $board[2][$i];
                }
            }
        }

        return false;

    }

    // Todo : improve the verification on this function
    // it can be hard to debug and test in the way it is wrote
    public function hasFinished()
    {
        $result = array(
            'has_finished'  => 'no',
            'winner_player' => ''
        );

        $check_methods = array(
            'hasWinnerDiagonal',
            'hasWinnerAntiDiagonal',
            'hasWinnerHorizontalOrVertical',
        );

        foreach ($check_methods as $method) {
            $has_winner = $this->{$method}();

            if ($has_winner) {
                $result['has_finished'] = 'yes';
                $result['winner_player'] = $has_winner;
                return $result;
            }
        }

        // check draw
        if (!$this->board->getAvailablePositions()) {
            $result['has_finished'] = 'yes';
            $result['winner_player'] = 'Draw';
            return $result;
        }

        return $result;

    }
}