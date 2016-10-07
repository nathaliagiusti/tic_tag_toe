<?php

class GameTest extends TestCase
{
    protected $game;

    /**
     * it runs before every test case
     *
     * @return void
     */
    public function setUp()
    {
        // Todo: Replace later
        if (isset($_SESSION['board_state'])) {
            unset($_SESSION['board_state']);
        }

        $this->game = new App\Game();

    }

    /**
     * test players unit setting
     *
     * @return void
     */
    public function testInvalidPlayer()
    {

    }

    /**
     * test make move
     *
     * @return void
     */
    public function testMakeMove()
    {
        $this->game->makeMove(0, 0, 'X');

        $cell = $this->game->board->getPositionContent(0,0);

        $this->assertEquals($cell, 'X');

    }

    /**
     * test try to replace the content of a cell in the board
     *
     * @return void
     */
    public function testOverwritePositionContent()
    {
        $this->game->makeMove(0, 0, 'X');
        $this->game->makeMove(0, 0, 'O');

        $cell = $this->game->board->getPositionContent(0,0);

        $this->assertEquals($cell, 'X');

    }

    /**
     * test make two moves
     *
     * @return void
     */
    public function testMakeTwoMoves()
    {
        $this->game->makeMove(0, 0, 'X');
        $this->game->makeMove(0, 1, 'O');

        $cell = $this->game->board->getPositionContent(0,0);
        $this->assertEquals($cell, 'X');

        $cell = $this->game->board->getPositionContent(0,1);
        $this->assertEquals($cell, 'O');

    }

    /**
     * test has winner on diagonal
     *
     * @return void
     */
    public function testHasWinnerDiagonal()
    {
        $this->game->makeMove(0, 0, 'X');
        $this->game->makeMove(1, 1, 'X');
        $this->game->makeMove(2, 2, 'X');

        $has_winner = $this->game->hasWinnerDiagonal();

        $this->assertEquals($has_winner, 'X');
    }

    /**
     * test has winner on anti diagonal
     *
     * @return void
     */
    public function testHasWinnerAntiDiagonal()
    {
        $this->game->makeMove(0, 2, 'O');
        $this->game->makeMove(1, 1, 'O');
        $this->game->makeMove(2, 0, 'O');

        $has_winner = $this->game->hasWinnerAntiDiagonal();

        $this->assertEquals($has_winner, 'O');
    }

    /**
     * test has winner on horizontal
     *
     * @return void
     */
    public function testHasWinnerHorizontal()
    {
        $this->game->makeMove(1, 0, 'X');
        $this->game->makeMove(1, 1, 'X');
        $this->game->makeMove(1, 2, 'X');

        $has_winner = $this->game->hasWinnerHorizontalOrVertical();

        $this->assertEquals($has_winner, 'X');
    }

    /**
     * test has winner on horizontal
     *
     * @return void
     */
    public function testHasWinnerVertical()
    {
        $this->game->makeMove(2, 0, 'O');
        $this->game->makeMove(2, 1, 'O');
        $this->game->makeMove(2, 2, 'O');

        $has_winner = $this->game->hasWinnerHorizontalOrVertical();

        $this->assertEquals($has_winner, 'O');
    }

    /**
     * test draw
     *
     * @return void
     */
    public function testDraw()
    {
        $this->game->makeMove(0, 0, 'X');
        $this->game->makeMove(0, 1, 'X');
        $this->game->makeMove(0, 2, 'O');
        $this->game->makeMove(1, 0, 'O');
        $this->game->makeMove(1, 1, 'O');
        $this->game->makeMove(1, 2, 'X');
        $this->game->makeMove(2, 0, 'X');
        $this->game->makeMove(2, 1, 'O');
        $this->game->makeMove(2, 2, 'X');

        $result = $this->game->hasFinished();

        $this->assertEquals($result['winner_player'], 'Draw');

    }
}
