<?php

declare(strict_types=1);

interface CostStrategy
{
    public function cost(int $startingPosition, int $currentPosition): int;
}
