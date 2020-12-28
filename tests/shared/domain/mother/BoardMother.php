<?php

namespace tests\shared\domain\mother;

use GameofLife\domain\entity\Board;
use GameofLife\domain\entity\Cell;
use GameofLife\domain\exception\CoordinateNotValid;

class BoardMother
{
    /**
     * @throws CoordinateNotValid
     */
    public static function createUnderPopulation(): Board
    {
        // 0 1 0          0 0 0
        // 0 0 0    =>    0 0 0
        // 0 0 0          0 0 0
        $board = Board::createEmpty(3, 3);
        $board->addCell(0, 0, Cell::createDead());
        $board->addCell(0, 1, Cell::createLive());
        $board->addCell(0, 2, Cell::createDead());
        $board->addCell(1, 0, Cell::createDead());
        $board->addCell(1, 1, Cell::createDead());
        $board->addCell(1, 2, Cell::createDead());
        $board->addCell(2, 0, Cell::createDead());
        $board->addCell(2, 1, Cell::createDead());
        $board->addCell(2, 2, Cell::createDead());
        return $board;
    }

    /**
     * @return Board
     * @throws CoordinateNotValid
     */
    public static function createOverCrowding(): Board
    {
        // 1 1 1          1 0 1
        // 0 1 1    =>    0 0 1
        // 0 0 0          0 0 0
        $board = Board::createEmpty(3, 3);
        $board->addCell(0, 0, Cell::createLive());
        $board->addCell(0, 1, Cell::createLive());
        $board->addCell(0, 2, Cell::createLive());
        $board->addCell(1, 0, Cell::createDead());
        $board->addCell(1, 1, Cell::createLive());
        $board->addCell(1, 2, Cell::createLive());
        $board->addCell(2, 0, Cell::createDead());
        $board->addCell(2, 1, Cell::createDead());
        $board->addCell(2, 2, Cell::createDead());
        return $board;
    }

    /**
     * @return Board
     * @throws CoordinateNotValid
     */
    public static function createReproduction(): Board
    {
        // 0 1 0          1 1 0
        // 1 1 0    =>    1 1 0
        // 0 0 0          0 0 0
        $board = Board::createEmpty(3, 3);
        $board->addCell(0, 0, Cell::createDead());
        $board->addCell(0, 1, Cell::createLive());
        $board->addCell(0, 2, Cell::createDead());
        $board->addCell(1, 0, Cell::createLive());
        $board->addCell(1, 1, Cell::createLive());
        $board->addCell(1, 2, Cell::createDead());
        $board->addCell(2, 0, Cell::createDead());
        $board->addCell(2, 1, Cell::createDead());
        $board->addCell(2, 2, Cell::createDead());
        return $board;
    }

    /**
     * @return Board
     * @throws CoordinateNotValid
     */
    public static function createUnchanged(): Board
    {
        // 1 1 0          1 1 0
        // 0 1 0    =>    0 1 0
        // 0 0 0          0 0 0
        $board = Board::createEmpty(3, 3);
        $board->addCell(0, 0, Cell::createLive());
        $board->addCell(0, 1, Cell::createLive());
        $board->addCell(0, 2, Cell::createDead());
        $board->addCell(1, 0, Cell::createDead());
        $board->addCell(1, 1, Cell::createLive());
        $board->addCell(1, 2, Cell::createDead());
        $board->addCell(2, 0, Cell::createDead());
        $board->addCell(2, 1, Cell::createDead());
        $board->addCell(2, 2, Cell::createDead());
        return $board;
    }

    /**
     * @return Board
     * @throws CoordinateNotValid
     */
    public static function createTestBoard(): Board
    {
        // 1 1 0 1 0         1 1 0 0 0
        // 0 1 0 1 0         1 1 0 1 0
        // 0 0 0 1 1    =>   1 1 0 0 0
        // 1 1 0 1 1         0 0 0 0 0
        // 1 1 1 0 0         0 0 0 1 0
        $board = Board::createEmpty(5, 5);
        $board->addCell(0, 0, Cell::createLive());
        $board->addCell(0, 1, Cell::createLive());
        $board->addCell(0, 2, Cell::createDead());
        $board->addCell(0, 3, Cell::createLive());
        $board->addCell(0, 4, Cell::createDead());

        $board->addCell(1, 0, Cell::createDead());
        $board->addCell(1, 1, Cell::createLive());
        $board->addCell(1, 2, Cell::createDead());
        $board->addCell(1, 3, Cell::createLive());
        $board->addCell(1, 4, Cell::createDead());

        $board->addCell(2, 0, Cell::createDead());
        $board->addCell(2, 1, Cell::createDead());
        $board->addCell(2, 2, Cell::createDead());
        $board->addCell(2, 3, Cell::createLive());
        $board->addCell(2, 4, Cell::createLive());

        $board->addCell(3, 0, Cell::createLive());
        $board->addCell(3, 1, Cell::createLive());
        $board->addCell(3, 2, Cell::createDead());
        $board->addCell(3, 3, Cell::createLive());
        $board->addCell(3, 4, Cell::createLive());

        $board->addCell(4, 0, Cell::createLive());
        $board->addCell(4, 1, Cell::createLive());
        $board->addCell(4, 2, Cell::createLive());
        $board->addCell(4, 3, Cell::createDead());
        $board->addCell(4, 4, Cell::createDead());
        return $board;
    }

    /**
     * @return Board
     * @throws CoordinateNotValid
     */
    public static function firstGeneration(): Board
    {
        // 1 1 0 1 0         1 1 0 0 0
        // 0 1 0 1 0         1 1 0 1 0
        // 0 0 0 1 1    =>   1 1 0 0 0
        // 1 1 0 1 1         1 0 0 0 1
        // 1 1 1 0 0         1 0 1 1 0
        $board = Board::createEmpty(5, 5);
        $board->addCell(0, 0, Cell::createLive());
        $board->addCell(0, 1, Cell::createLive());
        $board->addCell(0, 2, Cell::createDead());
        $board->addCell(0, 3, Cell::createDead());
        $board->addCell(0, 4, Cell::createDead());

        $board->addCell(1, 0, Cell::createLive());
        $board->addCell(1, 1, Cell::createLive());
        $board->addCell(1, 2, Cell::createDead());
        $board->addCell(1, 3, Cell::createLive());
        $board->addCell(1, 4, Cell::createDead());

        $board->addCell(2, 0, Cell::createLive());
        $board->addCell(2, 1, Cell::createLive());
        $board->addCell(2, 2, Cell::createDead());
        $board->addCell(2, 3, Cell::createDead());
        $board->addCell(2, 4, Cell::createDead());

        $board->addCell(3, 0, Cell::createLive());
        $board->addCell(3, 1, Cell::createDead());
        $board->addCell(3, 2, Cell::createDead());
        $board->addCell(3, 3, Cell::createDead());
        $board->addCell(3, 4, Cell::createLive());

        $board->addCell(4, 0, Cell::createLive());
        $board->addCell(4, 1, Cell::createDead());
        $board->addCell(4, 2, Cell::createLive());
        $board->addCell(4, 3, Cell::createLive());
        $board->addCell(4, 4, Cell::createDead());
        return $board;
    }
}