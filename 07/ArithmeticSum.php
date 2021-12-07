<?php

declare(strict_types=1);

final class ArithmeticSum implements CostStrategy
{
    public function cost(int $startingPosition, int $currentPosition): int
    {
        $numberOfSteps = abs($startingPosition - $currentPosition);

        return ((1 + $numberOfSteps) * $numberOfSteps) / 2;
    }
}
