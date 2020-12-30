<?php

namespace GameofLife\domain\entity;

use GameofLife\domain\exception\CoordinateNotValid;

final class Board
{
    private int $height;
    private int $width;
    private array $cells = [];

    private function __construct(int $height, int $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * @param int $height
     * @param int $width
     * @return Board
     * @throws CoordinateNotValid
     */
    public static function createRandom(int $height, int $width): self
    {
        $board = new self($height, $width);
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $board->addCell($x, $y, Cell::createRandom());
            }
        }
        return $board;
    }

    /**
     * @param int $height
     * @param int $width
     * @return Board
     */
    public static function createEmpty(int $height, int $width): self
    {
        return new self($height, $width);
    }

    /**
     * @param int $x
     * @param int $y
     * @param Cell $cell
     * @throws CoordinateNotValid
     */
    public function addCell(int $x, int $y, Cell $cell)
    {
        if($x >= $this->height || $y >= $this->width){
            throw new CoordinateNotValid('Max X: '. ($this->width-1) .', Max Y: '. ($this->height-1));
        }
        $this->cells[$x][$y] = $cell;
    }

    /**
     * @param int $x
     * @param int $y
     * @return Cell
     * @throws CoordinateNotValid
     */
    public function getCell(int $x, int $y): Cell
    {
        if($x >= $this->height || $y >= $this->width){
            throw new CoordinateNotValid('Max X: '. ($this->width-1) .', Max Y: '. ($this->height-1));
        }
        return $this->cells[$x][$y];
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }
}