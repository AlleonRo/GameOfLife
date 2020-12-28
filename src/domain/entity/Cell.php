<?php

namespace GameofLife\domain\entity;

use Exception;
use GameofLife\domain\enum\CellStatus;
use GameofLife\domain\enum\NeighboursRanges;
use GameofLife\domain\exception\CoordinateNotValid;

final class Cell
{
    private bool $state;

    private function __construct(bool $state)
    {
        $this->state = $state;
    }

    public static function createLive(): Cell
    {
        return new self(CellStatus::ALIVE);
    }

    public static function createDead(): Cell
    {
        return new self(CellStatus::DEAD);
    }

    public static function createRandom(): Cell
    {
        try {
            if (random_int(0, 1) === 1) {
                return self::createLive();
            }
        } catch (Exception $e) {
            //LOG ERROR
        }
        return self::createDead();
    }

    public function live(): void
    {
        $this->state = CellStatus::ALIVE;
    }

    public function die(): void
    {
        $this->state = CellStatus::DEAD;
    }

    public function isAlive(): bool
    {
        return CellStatus::ALIVE === $this->state;
    }

    public function isDead(): bool
    {
        return CellStatus::DEAD === $this->state;
    }

    /**
     * @param int $x
     * @param int $y
     * @param Board $board
     * @return int
     * @throws CoordinateNotValid
     */
    public function countNeighbours(int $x, int $y, Board $board): int
    {
        $countNeighbour = 0;
        foreach (NeighboursRanges::RANGES as $neighbourRange) {
            $xNeighbour = $x + $neighbourRange[0];
            $yNeighbour = $y + $neighbourRange[1];
            if (false === $this->validRange($xNeighbour, $yNeighbour, $board)) {
                continue;
            }
            if ($board->getCell($xNeighbour, $yNeighbour)->isAlive()) {
                $countNeighbour++;
            }
        }
        return $countNeighbour;
    }

    private function validRange(int $x, int $y, Board $board): bool
    {
        if ($x < 0 || $y < 0 || $x >= $board->getHeight() || $y >= $board->getWidth()) {
            return false;
        }
        return true;
    }
}