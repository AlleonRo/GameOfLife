<?php

namespace tests\unit\domain\entity;

use GameofLife\domain\entity\Board;
use GameofLife\domain\entity\Cell;
use GameofLife\domain\exception\CoordinateNotValid;
use PHPUnit\Framework\TestCase;

use function get_class;

class BoardTest extends TestCase
{
    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function createBoard(): void
    {
        $board = Board::createRandom(1, 1);
        self::assertEquals(Cell::class, get_class($board->getCell(0, 0)));
        self::assertEquals(1, $board->getHeight());
        self::assertEquals(1, $board->getWidth());
    }
}