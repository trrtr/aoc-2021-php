<?php

declare(strict_types=1);

class Crab
{
    private int $startingPosition;

    private int $currentPosition;

    public function __construct(int $startingPosition, int &$currentPosition)
    {
        $this->startingPosition = $startingPosition;
        $this->currentPosition = &$currentPosition;
    }

    public function cost(CostStrategy $costStrategy): int
    {
        return $costStrategy->cost($this->startingPosition, $this->currentPosition);
    }
}
