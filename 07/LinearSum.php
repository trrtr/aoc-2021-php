<?php

declare(strict_types=1);

final class LinearSum implements CostStrategy
{
    public function cost(int $startingPosition, int $currentPosition): int
    {
        return abs($startingPosition - $currentPosition);
    }
}
