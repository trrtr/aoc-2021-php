<?php

declare(strict_types=1);

final class Solution implements SolutionInterface
{
    public function task1($input): int
    {
        $ys = count($input);
        $xs = count($input[0]);
        $risk = 0;

        for ($y = 0; $y < $ys; $y++) {
            for ($x = 0; $x < $xs; $x++) {
                $point = PointWithNeighbours::fromBoard($x, $y, $input);
                if ($point->isLowest()) {
                    $risk += $point->riskLevel();
                }
            }
        }

        return $risk;
    }

    public function task2($input): int
    {
        $nodes = array_map(
            fn(array $row, int $y) => array_map(
                fn(int $number, int $x) => new Node($x, $y, $input[$y][$x]),
                $row,
                array_keys($row)
            ),
            $input,
            array_keys($input),
        );

        $ys = count($input);
        $xs = count($input[0]);
        $basinSizes = [];
        for ($y = 0; $y < $ys; $y++) {
            for ($x = 0; $x < $xs; $x++) {
                $basinSizes[] = $nodes[$y][$x]->spread($nodes);
            }
        }
        sort($basinSizes);
        $last = array_key_last($basinSizes);

        return $basinSizes[$last] * $basinSizes[$last - 1] * $basinSizes[$last - 2];
    }

    public function prepareInput(array $input): array
    {
        $input = array_filter($input);

        return array_map(fn(string $row) => array_map('intval', str_split($row)), $input);
    }
}
