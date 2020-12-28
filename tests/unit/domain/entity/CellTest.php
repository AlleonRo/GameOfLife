<?php

namespace tests\unit\domain\entity;

use GameofLife\domain\exception\CoordinateNotValid;
use PHPUnit\Framework\TestCase;
use GameofLife\domain\entity\Cell;
use tests\shared\domain\mother\BoardMother;

final class CellTest extends TestCase
{
    /**
     * @test
     */
    public function createCellAlive(): void
    {
        $cellAlive = Cell::createLive();
        self::assertTrue($cellAlive->isAlive());
    }

    /**
     * @test
     */
    public function createCellDead(): void
    {
        $cellDead = Cell::createDead();
        self::assertTrue($cellDead->isDead());
    }

    /**
     * @test
     */
    public function cellDie(): void
    {
        $cell = Cell::createLive();
        $cell->die();
        self::assertTrue($cell->isDead());
    }

    /**
     * @test
     */
    public function cellLive(): void
    {
        $cell = Cell::createDead();
        $cell->live();
        self::assertTrue($cell->isAlive());
    }

    /**
     * @test
     */
    public function createCellRandom(): void
    {
        $live = 0;
        $dead = 0;
        for ($i = 0; $i < 10; $i++) {
            $cell = Cell::createRandom();
            if ($cell->isAlive()) {
                $live++;
            } else {
                $dead++;
            }
        }
        self::assertGreaterThan(0, $live);
        self::assertGreaterThan(0, $dead);
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function atBottom(): void
    {
        $board = BoardMother::createOverCrowding();
        self::assertEquals(2, $board->getCell(2, 1)->countNeighbours(2, 1, $board));
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function atMiddle(): void
    {
        $board = BoardMother::createOverCrowding();
        self::assertEquals(4, $board->getCell(1, 1)->countNeighbours(1, 1, $board));
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function atTop(): void
    {
        $board = BoardMother::createOverCrowding();
        self::assertEquals(4, $board->getCell(0, 1)->countNeighbours(0, 1, $board));
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function atLeftTopCorner(): void
    {
        $board = BoardMother::createOverCrowding();
        self::assertEquals(2, $board->getCell(0, 0)->countNeighbours(0, 0, $board));
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function atRightBottomCorner(): void
    {
        $board = BoardMother::createOverCrowding();
        self::assertEquals(2, $board->getCell(2, 2)->countNeighbours(2, 2, $board));
    }
}