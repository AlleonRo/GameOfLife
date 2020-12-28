<?php

namespace GameofLife\domain\entity;

final class CellChanges
{
    private array $cellsToLive;
    private array $cellsToDie;

    private function __construct()
    {
        $this->cellsToDie = [];
        $this->cellsToLive = [];
    }

    public static function createEmpty(): CellChanges
    {
        return new self();
    }

    public function addCellToLive(Cell $cell){
        $this->cellsToLive[] = $cell;
    }

    public function addCellToDie(Cell $cell){
        $this->cellsToDie[] = $cell;
    }

    public function getCellsToLive(): array
    {
        return $this->cellsToLive;
    }

    public function getCellsToDie(): array
    {
        return $this->cellsToDie;
    }

    public function add(int $aliveNeighbours, Cell $cell): void
    {
        if ($this->underPopulation($cell, $aliveNeighbours)) {
            $this->addCellToDie($cell);
        }

        if ($this->overCrowding($cell, $aliveNeighbours)) {
            $this->addCellToDie($cell);
        }

        if ($this->reproduction($cell, $aliveNeighbours)) {
            $this->addCellToLive($cell);
        }
    }

    public function process(): void
    {
        foreach ($this->getCellsToDie() as $cellChange) {
            $cellChange->die();
        }
        foreach ($this->getCellsToLive() as $cellChange) {
            $cellChange->live();
        }
    }

    private function underPopulation(Cell $cell, int $aliveNeighbours): bool
    {
        return $cell->isAlive() && $aliveNeighbours < 2;
    }

    private function overCrowding(Cell $cell, int $aliveNeighbours): bool
    {
        return $cell->isAlive() && $aliveNeighbours > 3;
    }

    private function reproduction(Cell $cell, int $aliveNeighbours): bool
    {
        return $cell->isDead() && $aliveNeighbours === 3;
    }
}