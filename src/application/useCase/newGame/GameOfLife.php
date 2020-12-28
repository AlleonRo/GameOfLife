<?php

namespace GameofLife\application\useCase\newGame;

use GameofLife\domain\entity\Board;
use GameofLife\domain\entity\CellChanges;
use GameofLife\domain\exception\CoordinateNotValid;

final class GameOfLife
{
    private Board $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    /**
     * @throws CoordinateNotValid
     */
    public function nextGen(): void
    {
        $cellChanges = CellChanges::createEmpty();
        for ($x = 0; $x < $this->board->getHeight(); $x++) {
            for ($y = 0; $y < $this->board->getWidth(); $y++) {
                $aliveNeighbours = $this->board->getCell($x, $y)->countNeighbours($x, $y, $this->board);
                $cellChanges->add($aliveNeighbours, $this->board->getCell($x, $y));
            }
        }
        $cellChanges->process();
    }
}