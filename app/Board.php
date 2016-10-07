<?php

namespace App;

/**
 * Class Board
 */

class Board {

    public $state;

    public function __construct()
    {
        $this->start();
    }

    public function start()
    {
        if (isset($_SESSION['board_state'])) {
            $this->state = $_SESSION['board_state'];
        } else {
            // Todo : Use the size constant to generate the board

            $this->state = array(
                array("","",""),
                array("","",""),
                array("","",""),
            );

            $_SESSION['board_state'] = $this->state;

        }
    }

    public function getPositionContent($line, $column)
    {
        return $this->state[$line][$column];
    }

    public function isValidMove($line, $column)
    {
        return (bool) !$this->getPositionContent($line, $column);
    }

    /**
     * @param array $move [X, Y]
     * @param string $playerUnit X | O
     */
    public function markMove($line, $column, $playerUnit)
    {
        if ($this->isValidMove($line, $column)) {

            $this->state[$line][$column] = $playerUnit;
            $_SESSION['board_state']     = $this->state;
        }
    }

    public function delete()
    {
        unset($_SESSION['board_state']);
    }

    public function getAvailablePositions()
    {
        $positions = array();

        foreach ($this->state as $row_pos => $row) {
            foreach ($row as $field_pos => $field) {
                if (!$field) {
                    $positions[] = array($row_pos, $field_pos);
                }
            }
        }

        return $positions;
    }
}