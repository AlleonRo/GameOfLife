<?php

namespace tests\unit\domain\entity;

use GameofLife\domain\entity\Cell;
use GameofLife\domain\entity\CellChanges;
use PHPUnit\Framework\TestCase;

class CellChangesTest extends TestCase
{
    /**
     * @test
     */
    public function createEmpty(): void
    {
        $cellChanges = CellChanges::createEmpty();
        self::assertEmpty($cellChanges->getCellsToLive());
        self::assertEmpty($cellChanges->getCellsToDie());
    }

    /**
     * @test
     */
    public function addToLive(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellChanges->addCellToLive(Cell::createRandom());
        self::assertNotEmpty($cellChanges->getCellsToLive());
        self::assertEmpty($cellChanges->getCellsToDie());
    }

    /**
     * @test
     */
    public function addToDie(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellChanges->addCellToDie(Cell::createRandom());
        self::assertEmpty($cellChanges->getCellsToLive());
        self::assertNotEmpty($cellChanges->getCellsToDie());
    }

    /**
     * @test
     */
    public function addUnderPopulation(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellChanges->add(1, Cell::createLive());
        self::assertNotEmpty($cellChanges->getCellsToDie());
    }

    /**
     * @test
     */
    public function addOverCrowding(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellChanges->add(4, Cell::createLive());
        self::assertNotEmpty($cellChanges->getCellsToDie());
    }

    /**
     * @test
     */
    public function addReproduction(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellChanges->add(3, Cell::createDead());
        self::assertNotEmpty($cellChanges->getCellsToLive());
    }

    /**
     * @test
     */
    public function addUnchanged(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellChanges->add(2, Cell::createLive());
        self::assertEmpty($cellChanges->getCellsToLive());
        self::assertEmpty($cellChanges->getCellsToDie());
    }

    /**
     * @test
     */
    public function addUnchangedDie(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellDieExpected = Cell::createLive();
        $cellChanges->addCellToDie($cellDieExpected);
        $cellChanges->process();
        self::assertTrue($cellDieExpected->isDead());
    }

    /**
     * @test
     */
    public function addUnchangedLive(): void
    {
        $cellChanges = CellChanges::createEmpty();
        $cellLiveExpected = Cell::createDead();
        $cellChanges->addCellToLive($cellLiveExpected);
        $cellChanges->process();
        self::assertTrue($cellLiveExpected->isAlive());
    }
}