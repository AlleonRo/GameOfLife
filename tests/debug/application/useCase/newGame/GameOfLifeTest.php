<?php

namespace tests\debug\application\useCase\newGame;

use GameofLife\application\useCase\newGame\GameOfLife;
use GameofLife\domain\entity\Board;
use GameofLife\domain\exception\CoordinateNotValid;
use PHPUnit\Framework\TestCase;

class GameOfLifeTest extends TestCase
{
    /**
     * @test
     * @throws CoordinateNotValid
     */
    public function game(): void
    {
        $generations = 5;
        $board = Board::createRandom(16, 16);
        $newGame = new GameOfLife($board);
        $this->cleanResults($generations);
        for ($i = 0; $i < $generations; $i++) {
            $this->render($board, $i + 1);
            $newGame->nextGen();
        }
        self::assertEquals($generations, $i);
    }

    /**
     * @param Board $board
     * @param int $generation
     * @throws CoordinateNotValid
     */
    private function render(Board $board, int $generation): void
    {
        $file = fopen(__DIR__ . "/results/generation_{$generation}.txt", "w");
        for ($x = 0; $x < $board->getHeight(); $x++) {
            $line = '';
            for ($y = 0; $y < $board->getWidth(); $y++) {
                $line .= $board->getCell($x, $y)->isAlive() ? '1 ' : '0 ';
            }
            fwrite($file, $line . PHP_EOL);
        }
        fclose($file);
    }

    private function cleanResults(int $generations)
    {
        for ($i = 1; $i <= $generations; $i++) {
            if (file_exists(__DIR__ . "/results/generation_{$i}.txt")) {
                unlink(__DIR__ . "/results/generation_{$i}.txt");
            }
        }
    }
}