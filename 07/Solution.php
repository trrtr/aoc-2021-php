<?php

declare(strict_types=1);

final class Solution implements SolutionInterface
{
    private static int $currentPosition;

    private int $maxPosition;

    /**
     * @param array<Crab> $crabs
     *
     * @return int
     */
    public function task1($crabs): int
    {
        $strategy = new LinearSum();

        return $this->calculateCost($crabs, $strategy);
    }

    /**
     * @param array<Crab> $crabs
     *
     * @return int
     */
    public function task2($crabs): int
    {
        $strategy = new ArithmeticSum();

        return $this->calculateCost($crabs, $strategy);
    }

    /**
     * @param array<Crab> $crabs
     *
     * @return int
     */
    private function calculateCost(array $crabs, CostStrategy $strategy): int
    {
        $minCost = PHP_INT_MAX;
        for ($i = static::$currentPosition; $i <= $this->maxPosition; $i++) {
            $cost = array_reduce($crabs, fn(int $sum, Crab $crab) => $sum + $crab->cost($strategy), 0);
            $minCost = $minCost > $cost ? $cost : $minCost;
            self::$currentPosition++;
        }

        return $minCost;
    }

    public function prepareInput(array $input): array
    {
        $array = explode(',', $input[0]);
        $integers = array_map('intval', $array);
        self::$currentPosition = min($integers);
        $this->maxPosition = max($integers);

        return array_map(static fn(int $value) => new Crab($value, self::$currentPosition), $integers);
    }
}
