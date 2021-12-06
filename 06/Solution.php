<?php

declare(strict_types=1);

final class Solution implements SolutionInterface
{
    /**
     * @param array<LanternFish> $input
     *
     * @return int
     */
    public function task1($input): int
    {
        $school = new OptimizedSchool($input);
        $school->passDays(80);

        return $school->fishCount();
    }

    public function task2($input): int
    {
        $school = new OptimizedSchool($input);
        $school->passDays(256);

        return $school->fishCount();
    }

    public function prepareInput(array $input): array
    {
        $array = explode(',', $input[0]);
        $integers = array_map('intval', $array);

        return array_map(static fn(int $value) => LanternFish::new($value), $integers);
    }
}
