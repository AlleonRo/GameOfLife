<?php

namespace tests\unit\application\useCase\newGame;

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
    public function nextGenUnderPopulation(): void
    {
        $board = BoardMother::createUnderPopulation();
        $subjectUnderTest = new GameOfLife($board);
        $subjectUnderTest->nextGen();
        self::assertTrue($board->getCell(0, 1)->isDead());
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function nextGenOverCrowding(): void
    {
        $board = BoardMother::createOverCrowding();
        $subjectUnderTest = new GameOfLife($board);
        $subjectUnderTest->nextGen();
        self::assertTrue($board->getCell(0, 1)->isDead());
        self::assertTrue($board->getCell(1, 1)->isDead());
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function nextGenReproduction(): void
    {
        $board = BoardMother::createReproduction();
        $subjectUnderTest = new GameOfLife($board);
        $subjectUnderTest->nextGen();
        self::assertTrue($board->getCell(0, 0)->isAlive());
    }

    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function nextGenUnchanged(): void
    {
        $board = BoardMother::createUnchanged();
        $subjectUnderTest = new GameOfLife($board);
        $subjectUnderTest->nextGen();
        self::assertTrue($board->getCell(0, 0)->isAlive());
    }
}