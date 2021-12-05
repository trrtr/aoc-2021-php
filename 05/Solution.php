<?php

declare(strict_types=1);

include __DIR__ . '/../SolutionInterface.php';
include __DIR__ . '/Point.php';
include __DIR__ . '/Line.php';
include __DIR__ . '/Board.php';

final class Solution implements SolutionInterface
{
    /**
     * @param array<Line> $input
     *
     * @return int
     */
    public function task1($input): int
    {
        $board = new Board();
        $input = array_filter($input, fn (Line $l) => $l->isHorizontalOrVertical());
        foreach ($input as $line) {
            $board->addLine($line);
        }

        return $board->getAnswer();
    }

    public function task2($input): int
    {
        $board = new Board();
        foreach ($input as $line) {
            $board->addLine($line);
        }

        return $board->getAnswer();
    }

    public function prepareInput(array $input): array
    {
        $input = array_filter($input);
        $stringPoints = array_map(fn(string $twoPoints) => explode(' -> ', $twoPoints), $input);
        $points = array_map(
            fn(array $twoPoints) => array_map(
                fn(string $coordinates) => Point::fromString($coordinates),
                $twoPoints,
            ),
            $stringPoints,
        );

        return array_map(fn(array $twoPoints) => Line::fromEnds(...$twoPoints), $points);
    }
}
