<?php

namespace tests\functional\application\useCase\newGame;

use GameofLife\application\useCase\newGame\GameOfLife;
use GameofLife\domain\exception\CoordinateNotValid;
use PHPUnit\Framework\TestCase;
use tests\shared\domain\mother\BoardMother;

class GameOfLifeTest extends TestCase
{
    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function firstGeneration(): void
    {
        $board = BoardMother::createTestBoard();
        $newGame = new GameOfLife($board);
        $newGame->nextGen();
        $boardExpected = BoardMother::firstGeneration();
        self::assertEquals($board, $boardExpected);
    }
}